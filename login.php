<?php
session_start();
require_once("includes/db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT password_hash FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password_hash"])) {
            $_SESSION["authenticated"] = true;
            header("Location: dashboard.php"); // Redirect to dashboard page
            exit();
        } else {
            $loginError = "Invalid username or password";
        }
    } else {
        $loginError = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
 <div class="form-container">
    <h2>Login</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</div>

</body>

</html>