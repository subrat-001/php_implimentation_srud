<?php
require_once("../includes/db_connection.php");
require_once("../includes/auth.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $salary = $_POST["salary"];
    $dob = $_POST["dob"];
    $company_id = $_POST["company_id"];

    // Perform validation here

    $sql = "INSERT INTO Employee (name, salary, dob, company_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsi", $name, $salary, $dob, $company_id);

    if ($stmt->execute()) {
        header("Location: employee_read.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$companies = array();
$sql = "SELECT id, company_name FROM Company";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $companies = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Employee</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>   
     <header>
                <div class="logout-container">
            <a class="action-link" href="../logout.php">Logout</a>
        </div>

    </header>
    <!-- Create Employee Form in HTML -->
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary" min="10000" max="50000" required>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>

        <label for="company_id">Company:</label>
        <select id="company_id" name="company_id" required>
            <option value="" disabled selected>Select a company</option>
            <?php foreach ($companies as $company) { ?>
                <option value="<?php echo $company['id']; ?>"><?php echo $company['company_name']; ?></option>
            <?php } ?>
        </select>

        <button type="submit">Add Employee</button>
    </form>
</body>

</html>