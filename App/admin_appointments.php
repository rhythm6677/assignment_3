<?php
// Database connection
$servername = "db";
$username = "user";
$password = "password";
$dbname = "car_workshop";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch appointments
$sql = "SELECT a.id, a.name, a.phone, a.car_license_number, a.appointment_date, a.mechanic_name 
        FROM appointments a";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['name'] . "</td>
                <td>" . $row['phone'] . "</td>
                <td>" . $row['car_license_number'] . "</td>
                <td>" . $row['appointment_date'] . "</td>
                <td>" . $row['mechanic_name'] . "</td>
                <td><button class='save-btn'>Save</button></td>
              </tr>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
