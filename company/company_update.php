<!DOCTYPE html>
<html>

<head>
    <title>Update Company</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php
    require_once("../includes/db_connection.php");
    require_once("../includes/auth.php");

    $row = array(); // Initialize $row as an empty array
    $updateStatus = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $newCompanyName = $_POST["new_company_name"];
        $address = $_POST["address"];

        $sql = "UPDATE Company SET company_name=?, address=? WHERE Id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $newCompanyName, $address, $id);

        if ($stmt->execute()) {
            header("Location: company_read.php"); // Redirect to company_read.php
            exit();
        } else {
            $updateStatus = 'Error updating company information: ' . $stmt->error;
        }
    } elseif (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "SELECT * FROM Company WHERE Id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            $updateStatus = 'No company found with the provided ID.';
        }
    }
    ?>

    <!-- Update Company Form in HTML -->
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $row["Id"]; ?>">

        <label for="new_company_name">New Company Name:</label>
        <input type="text" id="new_company_name" name="new_company_name"
            value="<?php echo isset($row["company_name"]) ? $row["company_name"] : ''; ?>" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address"
            value="<?php echo isset($row["address"]) ? $row["address"] : ''; ?>" required>

        <button type="submit">Update Company Information</button>
    </form>

    <p>
        <?php echo $updateStatus; ?>
    </p>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($updateStatus)): ?>
        <p>Updated</p>
    <?php endif; ?>
</body>

</html>
