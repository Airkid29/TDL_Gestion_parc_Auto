-- Creation de la base de donnés "Vehicle_reservation", des differentes tables(users, vehicles, reservations).

CREATE DATABASE IF NOT EXISTS vehicle_reservation;
USE vehicle_reservation;


CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,
    registration_number VARCHAR(255) UNIQUE NOT NULL,
    image_path VARCHAR(255) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    vehicle_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE
);

ALTER TABLE users ADD CONSTRAINT chk_email_format CHECK (email LIKE '%_@__%.__%');
ALTER TABLE reservations ADD CONSTRAINT chk_date_order CHECK (start_date <= end_date);

CREATE INDEX idx_user_id ON reservations (user_id);
CREATE INDEX idx_vehicle_id ON reservations (vehicle_id);
CREATE INDEX idx_start_date ON reservations (start_date);
CREATE INDEX idx_end_date ON reservations (end_date);

-- Insert sample data
INSERT INTO users (name, email, password, is_admin) VALUES
('Admin User', 'admin@example.com', '$2y$12$y3x/.wxaQo6JZ4SJHS.f1Orxl5chuDSl.i/uBOXmS44GSx8f8QaFC', TRUE),
('John Doe', 'john@example.com', '$2y$12$y3x/.wxaQo6JZ4SJHS.f1Orxl5chuDSl.i/uBOXmS44GSx8f8QaFC', FALSE);
-- Note: Password is 'admin123' (hash) for both users for simplicity in this demo

INSERT INTO vehicles (brand, model, registration_number, image_path) VALUES
('Toyota', 'Corolla', 'TG-2024-CR', '../assets/images/vehicles/Corolla.jpeg'),
('Toyota', 'Land Cruiser', 'TG-5566-LC', '../assets/images/vehicles/Land_cruiser.png'),
('Toyota', 'Land Cruiser 300', 'TG-9988-LC', '../assets/images/vehicles/Cruiser300.png'),
('Toyota', 'Hilux', 'TG-1122-HL', '../assets/images/vehicles/Toyota-Hilux.webp'),
('Toyota', 'RAV4', 'TG-3344-RV', '../assets/images/vehicles/TOYOYA-RAV4.webp'),
('Toyota', 'Yaris', 'TG-7788-YS', '../assets/images/vehicles/Yaris.png'),
('Mitsubishi', 'L200', 'TG-4455-MS', '../assets/images/vehicles/MITSUBISHI-L200.webp');

INSERT INTO reservations (user_id, vehicle_id, start_date, end_date) VALUES
(1, 1, '2026-01-20', '2026-01-25'),
(2, 2, '2026-01-22', '2026-01-24'),
(2, 3, '2026-01-23', '2026-01-26');