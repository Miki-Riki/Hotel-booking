<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('db_adm_conn.php');

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row["password"];

        if (password_needs_rehash($stored_password, PASSWORD_DEFAULT)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $update_sql = "UPDATE admin SET password = '$hashed_password' WHERE username = '$username'";
            $conn->query($update_sql);
        } else {
            if (password_verify($password, $stored_password)) {
                $_SESSION["admin_id"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                header("Location: dashboard.php");
                exit();
            } else {
                http_response_code(400);
                echo "Invalid password";
            }
        }
    } else {
        http_response_code(400);
        echo "Admin not found";
    }

    $conn->close();
}
?>
