<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ur_db_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
