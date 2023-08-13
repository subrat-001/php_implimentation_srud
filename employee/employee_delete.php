<?php
require_once("../includes/db_connection.php");
require_once("../includes/auth.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM Employee WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: employee_read.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>