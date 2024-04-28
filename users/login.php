<?php
session_start();

require_once '../database/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Set session variables after successful login
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_email"] = $row["email"];
            $stmt->close();
            $conn->close();
            header("Location: user_profile.php");
            exit();
        } else {
            http_response_code(400);
            echo "Invalid password";
        }
    } else {
        http_response_code(400);
        echo "User not found";
    }

    $stmt->close();
    $conn->close();
}
?>
