<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../database/db_connection.php';

    // Validate user input
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid user ID.']);
        exit();
    }

    $user_id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

    if ($_SESSION["user_id"] == $user_id) {
        echo json_encode(['status' => 'error', 'message' => 'Cannot delete currently logged-in user.']);
        exit();
    }

    // Prepare and execute SQL statement using prepared statement
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();

    // Check if deletion was successful
    if ($stmt->affected_rows > 0) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting user.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
