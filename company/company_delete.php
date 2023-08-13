<?php
require_once("../includes/db_connection.php");
require_once("../includes/auth.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM Company WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: company_read.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>