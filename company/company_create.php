<!DOCTYPE html>
<html>

<head>
    <title>Create Company</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php
    require_once("../includes/db_connection.php");
    require_once("../includes/auth.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $companyName = $_POST["company_name"];
        $address = $_POST["address"];

        $sql = "INSERT INTO Company (company_name, address) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $companyName, $address);

        if ($stmt->execute()) {
            header("Location: company_read.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $stmt->error;
        }
    }
    ?>

    <!-- Create Company Form in HTML -->
    <form method="post" action="">
        <label for="company_name">Company Name:</label>
        <input type="text" id="company_name" name="company_name" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <button type="submit">Create Company</button>
    </form>
</body>

</html>