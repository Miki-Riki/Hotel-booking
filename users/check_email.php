<?php

include '../database/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Using prepared statements to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $check_email_query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Checking if user with the provided email already exists
    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'User with this email already exists. Please choose a different email.']);
    } else {
        echo json_encode(['status' => 'success']);
    }

    $stmt->close();
    $conn->close();
}
