<?php
$host = 'localhost';
$db = 'u_240364274_db';
$user = 'u-240364274';
$pass = '98oIf7juB6hvDo3'; // mysql password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
?>