CREATE DATABASE IF NOT EXISTS bloodbank_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bloodbank_db;

CREATE TABLE IF NOT EXISTS donors (
    donor_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    age INT,
    email VARCHAR(100),
    phone VARCHAR(20),
    address VARCHAR(255),
    medical_history TEXT,
    blood_group VARCHAR(5),
    last_donation_date DATE
);

CREATE TABLE IF NOT EXISTS blood_donations (
    donation_id INT AUTO_INCREMENT PRIMARY KEY,
    donor_id INT,
    blood_group VARCHAR(5),
    quantity_ml INT,
    donation_date DATE,
    FOREIGN KEY (donor_id) REFERENCES donors(donor_id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS blood_inventory (
    blood_group VARCHAR(5) PRIMARY KEY,
    quantity_ml INT,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO blood_inventory (blood_group, quantity_ml) VALUES
('A+',0),('A-',0),('B+',0),('B-',0),('AB+',0),('AB-',0),('O+',0),('O-',0)
ON DUPLICATE KEY UPDATE quantity_ml=VALUES(quantity_ml);

CREATE TABLE IF NOT EXISTS hospital_requests (
    hospital_id INT AUTO_INCREMENT PRIMARY KEY,
    hospital_name VARCHAR(100),
    blood_group VARCHAR(5),
    quantity_ml INT,
    request_date DATE,
    status VARCHAR(20) DEFAULT 'Pending',
    fulfilled_date DATE
);
