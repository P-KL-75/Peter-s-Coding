<?php
// Database connection parameters
$hostname = 'localhost';
$username = 'root';      
$password = '';         
$database = 'agroculture';

// Attempt to establish a connection to the database
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
