<?php
require_once("../includes/db_connection.php");
require_once("../includes/auth.php");

$row = array(); // Initialize $row as an empty array

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $dob = $_POST["dob"];
    $newCompany = $_POST["new_company"];
    $salary = $_POST["salary"];

    // Get company ID based on company name
    $company_id = getCompanyId($conn, $newCompany);

    if ($company_id !== null) {
        $sql = "UPDATE Employee SET name=?, dob=?, company_id=?, salary=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssids", $name, $dob, $company_id, $salary, $id);

        if ($stmt->execute()) {
            header("Location: employee_read.php"); // Redirect to employee_read.php
            exit();
        } else {
            echo "Error updating employee: " . $stmt->error;
        }
    } else {
        echo "Error: Company not found.";
    }
} elseif (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM Employee WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No employee found with the provided ID.";
    }
}

function getCompanyId($conn, $company_name)
{
    $sql = "SELECT id FROM Company WHERE company_name=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $company_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["id"];
    } else {
        return null;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Employee Information</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <!-- Update Employee Form -->
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $row["Id"]; ?>">

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo isset($row["name"]) ? $row["name"] : ''; ?>"
            required>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" value="<?php echo isset($row["dob"]) ? $row["dob"] : ''; ?>" required>

        <label for="new_company">New Company:</label>
        <select id="new_company" name="new_company" required>
            <?php
            $companyNames = array(); // Store company names for dropdown
            
            $sql = "SELECT company_name FROM Company";
            $result = $conn->query($sql);

            while ($company = $result->fetch_assoc()) {
                $companyNames[] = $company["company_name"];
            }

            foreach ($companyNames as $company) {
                $selected = ($row["company_name"] === $company) ? "selected" : "";
                echo "<option value='$company' $selected>$company</option>";
            }
            ?>
        </select>

        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary"
            value="<?php echo isset($row["salary"]) ? $row["salary"] : ''; ?>" min="10000" max="50000" required>

        <button type="submit">Update Employee</button>
    </form>
</body>

</html>