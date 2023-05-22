<?php
// Include the necessary files and establish a database connection
require 'config.php';

// Retrieve the request data
$data = json_decode(file_get_contents("php://input"), true);

// Perform data validation and sanitization

// Check if the user already exists in the database
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$data['email']]);
$user = $stmt->fetch();

if ($user) {
    // User already exists
    $response = [
        'message' => 'User with this email already exists.'
    ];
} else {
    // Insert the new user into the database
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, phone_number) VALUES (?, ?, ?, ?)");
    $stmt->execute([$data['username'], $data['email'], password_hash($data['password'], PASSWORD_DEFAULT), $data['phone_number']]);
    
    // User registration successful
    $response = [
        'message' => 'User registration successful.'
    ];
}

// Set the appropriate headers and encode the response data as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
