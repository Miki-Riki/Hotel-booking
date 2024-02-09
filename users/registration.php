<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli('localhost', 'root', '', 'hotels');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $password = password_hash(mysqli_real_escape_string($conn, $_POST["password"]), PASSWORD_DEFAULT); 
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);

    if (!empty($_FILES["profile_image"]["name"])) {
        $target_directory = "images/";
        $profile_image = basename($_FILES["profile_image"]["name"]);
        $target_file = $target_directory . $profile_image;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowedImageTypes = ['image/jpeg', 'image/png'];
        if (in_array($_FILES['profile_image']['type'], $allowedImageTypes)) {
            $maxFileSize = 5 * 1024 * 1024; // 5 MB in bytes
            if ($_FILES['profile_image']['size'] <= $maxFileSize) {
                // Process and move the uploaded image file
                $imagePath = '../images/' . basename($_FILES['profile_image']['name']);
                move_uploaded_file($_FILES['profile_image']['tmp_name'], $imagePath);
            } else {
                // File size exceeds the limit
                echo json_encode(['status' => 'error', 'message' => 'File size exceeds the limit (5 MB).']);
                exit;
            }
        } else {
            // Invalid file type
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type. Please upload a JPEG or a PNG file.']);
            exit;
        }
    } else {
        $imagePath = 'images/user.png';
    }


    $sql = "INSERT INTO users (first_name, last_name, email, phone, password, profile_image, gender)
                VALUES ('$first_name', '$last_name', '$email', '$phone', '$password', '$imagePath', '$gender')";

    if ($conn->query($sql) === TRUE) {
        json_encode(['status' => 'success']);

        $conn->close();

        echo '<script>';
        echo 'Swal.fire({';
        echo '  icon: "success",';
        echo '  title: "Registration successful!",';
        echo '  showConfirmButton: false,';
        echo '  timer: 2000';
        echo '}).then(() => {';
        echo '  window.location.href = "/hoteli/index.php";';
        echo '});';
        echo '</script>';

        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error during registration. Please try again later.']);
    }

    $conn->close();
}
