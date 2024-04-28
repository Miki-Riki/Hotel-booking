<?php
include '../database/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['user_id']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email'])) {
        $userId = $_POST['user_id'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $sql = "UPDATE users SET first_name='$firstName', last_name='$lastName', email='$email' WHERE id=$userId";

        if ($conn->query($sql) === TRUE) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "All fields are required.";
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>
