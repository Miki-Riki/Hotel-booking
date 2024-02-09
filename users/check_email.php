<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli('localhost', 'root', '', 'hotels');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email_query);

    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'User with this email already exists. Please choose a different email.']);
    } else {
        echo json_encode(['status' => 'success']);
    }

    $conn->close();
}
