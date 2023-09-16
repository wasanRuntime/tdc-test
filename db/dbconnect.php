<?php
$host = "localhost"; // server name
$username = "root"; // database username
$password = ""; // database password
$dbname = "tdc_vehicles"; // database name

try {
    // Create a new PDO instance for database connection.
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set PDO to throw exceptions on error.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection error.
    die("Connection failed: " . $e->getMessage());
}
?>
