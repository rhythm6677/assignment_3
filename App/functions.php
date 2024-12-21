<?php
// Database connection function
function getDatabaseConnection() {
    $servername = "db"; // Hostname for the MySQL container
    $username = "user";
    $password = "password";
    $dbname = "car_workshop";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Function to insert appointment data into the database
function insertAppointment($name, $address, $phone, $license, $engine, $date, $mechanic) {
    $conn = getDatabaseConnection();

    $stmt = $conn->prepare(
        "INSERT INTO appointments (name, address, phone, car_license, car_engine, appointment_date, mechanic) 
        VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssssss", $name, $address, $phone, $license, $engine, $date, $mechanic);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
?>
