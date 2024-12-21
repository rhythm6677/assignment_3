-- Create database
CREATE DATABASE IF NOT EXISTS car_workshop;
USE car_workshop;

-- Create the mechanics table
CREATE TABLE mechanics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    specialization VARCHAR(255) DEFAULT NULL
);

-- Create the appointments table
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    license VARCHAR(255) NOT NULL,
    engine VARCHAR(255) NOT NULL,
    appointment_date DATE NOT NULL,
    mechanic_id INT NOT NULL,
    FOREIGN KEY (mechanic_id) REFERENCES mechanics(id) ON DELETE CASCADE
);

-- Insert sample mechanics
INSERT INTO mechanics (name, specialization)
VALUES 
    ('John Doe', 'Engine Repair'),
    ('Jane Smith', 'Transmission Specialist'),
    ('Mike Johnson', 'General Maintenance');


SELECT a.id, a.name AS client_name, a.phone, a.license, a.appointment_date, 
       m.id AS mechanic_id, m.name AS mechanic_name
FROM appointments a
LEFT JOIN mechanics m ON a.mechanic_id = m.id;

SELECT id, name FROM mechanics;




