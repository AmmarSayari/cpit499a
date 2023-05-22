<?php
// Include the necessary files and establish a database connection
require 'config.php';
// Retrieve the request data
$data = json_decode(file_get_contents("php://input"), true);

// Perform data validation and sanitization

// Check if the user exists in the database
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$data['email']]);
$user = $stmt->fetch();

if ($user && password_verify($data['password'], $user['password'])) {
    // User authentication successful
    $response = [
        'message' => 'Login successful.',
        'user' => [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email']
        ]
    ];
} else {
    // User authentication failed
    $response = [
        'message' => 'Invalid email or password.'
    ];
}

// Set the appropriate headers and encode the response data as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
