CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by VARCHAR(50) NOT NULL
);


CREATE TABLE IF NOT EXISTS flights (
  id INT AUTO_INCREMENT PRIMARY KEY,
  departure_station varchar(30) NOT NULL,
  arrival_station varchar(30) NOT NULL,
  flight_date varchar(12) NOT NULL,
  flight_time int NOT NULL
);

-- Insert sample users
INSERT INTO users (username, email, password, created_by) VALUES
('admin', 'admin@webgoat.com', 'admin123', 'system'),
('john_doe', 'john.doe@email.com', 'password123', 'admin'),
('maria_garcia', 'maria.garcia@email.com', 'maria2025', 'admin'),
('carlos_lopez', 'carlos.lopez@email.com', 'carlos123', 'admin'),
('ana_martinez', 'ana.martinez@email.com', 'ana2025', 'admin');

-- Insert sample flights
INSERT INTO flights (departure_station, arrival_station, flight_date, flight_time) VALUES
('Madrid', 'Barcelona', '2025-01-15', 800),
('Barcelona', 'Madrid', '2025-01-15', 1200),
('London', 'Paris', '2025-01-15', 900),
('Paris', 'London', '2025-01-15', 1500),
('New York', 'Los Angeles', '2025-01-16', 700),
('Los Angeles', 'New York', '2025-01-16', 1400),
('Madrid', 'London', '2025-01-16', 1100),
('Barcelona', 'Paris', '2025-01-16', 1300),
('London', 'Madrid', '2025-01-17', 1000),
('Paris', 'Barcelona', '2025-01-17', 1600);
