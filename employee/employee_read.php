<?php
require_once("../includes/db_connection.php");
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Employees</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <h1>Manage Employees</h1>
        <div class="logout-container">
            <a class="action-link" href="../logout.php">Logout</a>
            <br>
            <a class="action-link" href="../dashboard.php">Return</a>
        </div>
    </header>

    <div class="dashboard-links">
        <h2>Employees List</h2>
        <table class="employee-table">
            <tr>
                <th>Name</th>
                <th>Salary</th>
                <th>Date of Birth</th>
                <th>Company</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT e.id, e.name, e.salary, e.dob, c.company_name
                    FROM Employee e
                    LEFT JOIN Company c ON e.company_id = c.id";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["salary"] . "</td>";
                    echo "<td>" . $row["dob"] . "</td>";
                    echo "<td>" . $row["company_name"] . "</td>";
                    echo "<td><a href='employee_update.php?id=" . $row["id"] . "'>Edit</a> | <a href='employee_delete.php?id=" . $row["id"] . "'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No employees found.</td></tr>";
            }
            ?>
        </table>
                <ul>

            <li><a href="employee_create.php">Add Employee</a></li>
            </ul>
    </div>
</body>

</html>