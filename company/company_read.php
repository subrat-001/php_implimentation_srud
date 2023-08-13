<?php
require_once("../includes/db_connection.php");
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: ../login.php");
    exit();
}

// Fetch companies from the database
$sql = "SELECT * FROM Company";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Companies</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <h1>Manage Companies</h1>
        <div class="logout-container">
            <a class="action-link" href="../logout.php">Logout</a>
            <br>
            <a class="action-link" href="../dashboard.php">Return</a>
        </div>
    </header>

    <div class="dashboard-links">
        <table class="company-table">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['company_name']}</td>";
                    echo "<td>{$row['address']}</td>";
                    echo "<td><a href='company_update.php?id=" . $row["Id"] . "'>Edit</a> | <a href='company_delete.php?id=" . $row["Id"] . "'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
                <br>
        <ul>

        <li><a href="company_create.php">Add Company</a></li>
            </ul>
    </div>
</body>

</html>