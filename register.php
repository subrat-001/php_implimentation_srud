<?php
require_once("includes/db_connection.php");

$registrationSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password_hash) VALUES ('$username', '$hashedPassword')";
    if ($conn->query($sql) === true) {
        $registrationSuccess = true;
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
        <h2>Register</h2>
        <?php if ($registrationSuccess): ?>
            <p>Registration successful! You can now <a href="login.php">login</a>.</p>
        <?php else: ?>
            <form method="post" action="">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="login.php">Login</a></p>
        <?php endif; ?>
    </div>
</body>

</html>