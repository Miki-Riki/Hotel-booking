<?php include('../components/links.php'); ?>

<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'hotels');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $profile_image = $row["profile_image"];
    $gender = $row["gender"];
    $conn->close();
} else {
    echo "User not found";
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div class="profile">
            <a href="../index.php">Go back</a>
            <h2>User Profile</h2>
            <?php

            if (!empty($profile_image) && file_exists($profile_image)) {
                echo '<img src="' . $profile_image . '" alt="Avatar">';
            } else {
                echo '<img src="../images/user.png" alt="Avatar">';
            }
            ?>
            <div class="info">
                <p><strong>Name:</strong> <?php echo $first_name . " " . $last_name; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Phone:</strong> <?php echo $phone; ?></p>
                <p><strong>Gender:</strong> <?php echo $gender; ?></p>
            </div>
            <form action="logout.php" method="POST">
                <button type="submit" class="btn btn-danger mt-2">Logout</button>
            </form>
        </div>

    </div>
</body>

</html>