<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../database/db_connection.php';

    if (isset($_POST['id'])) {
        $user_id = mysqli_real_escape_string($conn, $_POST['id']);
        $sql = "DELETE FROM users WHERE id = '$user_id'";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting user.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User ID not provided.']);
    }
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>