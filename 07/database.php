<?php
$host = 'localhost';
$db   = 'webshop';
$user = 'root';
$pass = ''; // Bij XAMPP leeg laten; gebruik 'root' als je MAMP op Mac gebruikt

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options); // nu PDO
} catch (PDOException $e) {
    die("Kan niet verbinden met de database: " . $e->getMessage());
}