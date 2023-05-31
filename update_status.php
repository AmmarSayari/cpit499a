<?php
require_once 'config.php';

$data = json_decode(file_get_contents("php://input"), true);


// Check if the required fields are valid
if (isset($data['order_id']) && isset($data['new_status'])) {
    $orderID = $data['order_id'];
    $newStatus = $data['new_status'];
} else {
    // Invalid request, missing required fields
    $response = [
        'message' => 'Invalid request. Required fields are missing.'
    ];

    // Set the appropriate headers and encode the response data as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}


// Update the status of the order in the database
$stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
$stmt->execute([$newStatus, $orderID]);

// Check if the update was successful
if ($stmt->rowCount() > 0) {
    // The update was successful
    $response = [
        'message' => 'Order status updated successfully.'
    ];
} else {
    // The update failed
    $response = [
        'message' => 'Failed to update order status.'
    ];
}

// Set the appropriate headers and encode the response data as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
