-- Create the database
CREATE DATABASE IF NOT EXISTS ecotrack_db;
USE ecotrack_db;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create calculations table
CREATE TABLE IF NOT EXISTS calculations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    electricity_consumption FLOAT,
    gas_consumption FLOAT,
    water_consumption FLOAT,
    vehicle_type VARCHAR(20),
    travel_km FLOAT,
    shopping FLOAT,
    diet VARCHAR(20),
    waste FLOAT,
    carbon_footprint FLOAT,
    calculated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
