<?php
session_start();
include 'includes/db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Checks if user is actually there
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        // Verifys password 
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['uid'];
            $_SESSION['username'] = $user['username'];
            
            // takes you to the homepage after login
            header("Location: index.php");  
            exit;
        } else {
            echo "Invalid credentials!";
        }
    } else {
        echo "User not found!";
    }
}
?>


<!-- Login Form -->
 <head>
    <link rel="stylesheet" href="/vkitchen/css/login_style.css">
</head>

 <header>
    <h1>Alex's virtual kitchen</h1>
    <h2>Login</h2>
</header>
<form method="POST">
    <input type="text" name="username" required placeholder="Username">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>