<?php
include 'functions.php'; // Include the function file

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $license = $_POST['license'];
    $engine = $_POST['engine'];
    $appointment_date = $_POST['date']; // Use 'appointment_date' for clarity
    $mechanic_id = $_POST['mechanic'];

    $conn = getDatabaseConnection();

    $stmt = $conn->prepare(
        "INSERT INTO appointments (name, address, phone, license, engine, appointment_date, mechanic_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("ssssssi", $name, $address, $phone, $license, $engine, $appointment_date, $mechanic_id);

    if ($stmt->execute()) {
        echo "Appointment successfully scheduled!";
    } else {
        echo "Failed to schedule the appointment. Please try again.";
    }

    $stmt->close();
    $conn->close();
}
?>
