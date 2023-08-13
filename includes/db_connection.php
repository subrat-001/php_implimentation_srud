<?php
$host = "localhost";
$username = "root";
$password = ""; // Enter your MySQL password here
$database = "Company"; // Change to the correct database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>