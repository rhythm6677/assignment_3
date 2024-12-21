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

$sql = "SELECT a.id, a.name AS client_name, a.phone, a.license, a.appointment_date, 
       m.id AS mechanic_id, m.name AS mechanic_name 
       FROM appointments a
       LEFT JOIN mechanics m ON a.mechanic_id = m.id";
$result = $conn->query($sql);

$appointments = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($appointments);