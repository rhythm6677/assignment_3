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

$data = json_decode(file_get_contents('php://input'), true);
$appointmentId = $data['id'];
$newDate = $data['date'];
$newMechanicId = $data['mechanic_id'];

// Check if the mechanic has reached the maximum number of appointments
$checkSql = "SELECT COUNT(*) AS appointment_count 
              FROM appointments 
              WHERE appointment_date = '$newDate' 
              AND mechanic_id = '$newMechanicId'";
$checkResult = $conn->query($checkSql);
$checkRow = $checkResult->fetch_assoc();

if ($checkRow['appointment_count'] >= 4) {
    http_response_code(400); 
    echo json_encode(['error' => 'This mechanic is fully booked for the selected date.']);
    exit;
}

$sql = "UPDATE appointments SET appointment_date = ?, mechanic_id = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $newDate, $newMechanicId, $appointmentId);

if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(['message' => 'Appointment updated successfully!']); 
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Error updating appointment: ' . $stmt->error]);
}

$stmt->close();
$conn->close();