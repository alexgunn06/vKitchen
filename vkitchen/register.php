<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Checks if the two passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit;
    }

    // Hashing the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Checks to see if username is already in databse
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        echo "Username already taken. Please choose another one.";
        exit;
    }

    // Inserts user into the database
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hashedPassword]);

    echo "Registration successful! <a href='login.php'>Login here</a>";
}
?>
<link rel="stylesheet" href="/vkitchen/css/register_style.css">
<!-- Register Form -->
<form method="POST">
    <input type="text" name="username" required placeholder="Username">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
    <input type="password" name="confirm_password" required placeholder="Confirm Password">
    <button type="submit">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login here</a></p>