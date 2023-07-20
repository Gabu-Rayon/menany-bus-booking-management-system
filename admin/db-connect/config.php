<?php
// Database connection settings
$host = 'localhost';
$dbname = 'menany-buses-database';
$username = 'root';
$password = '';

// Establish database connection using PDO
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}