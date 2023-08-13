<?php
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header>
        <h1>Welcome to Your Dashboard</h1>
            <div class="logout-container">
        <a class="action-link" href="logout.php">Logout</a>
    </div>
    </header>

    <div class="dashboard-links">
        <h2>Manage Your Data</h2>
        <ul>
            <li><a href="company/company_read.php">Manage Companies</a></li>
            <li><a href="employee/employee_read.php">Manage Employees</a></li>
        </ul>
    </div>
</body>

</html>