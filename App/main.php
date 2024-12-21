<?php
$servername = "db";
$username = "user";
$password = "password";
$database = "car_workshop";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
