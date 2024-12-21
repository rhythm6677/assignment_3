<?php
$servername = "db"; 
$username = "user";
$password = "password";
$dbname = "car_workshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name FROM mechanics";
$result = $conn->query($sql);

$mechanics = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $mechanics[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($mechanics);