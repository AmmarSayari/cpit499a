<?php
$host = 'localhost';
$dbName = 'spare_parts_app';
$username = 'root';
$password = 'passw0rd';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check the connection status
    $connectionStatus = $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);

    if ($connectionStatus === false) {
        // Connection failed
        echo "Database connection failed.";
    } else {
        // Connection successful
        echo "Database connection successful.";
    }
} catch (PDOException $e) {
    // Connection error
    echo "Database connection error: " . $e->getMessage();
}


?>
