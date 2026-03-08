CREATE DATABASE roammates;
USE roammates;

-- Trips table
CREATE TABLE trips (
    trip_id INT AUTO_INCREMENT PRIMARY KEY,
    trip_name VARCHAR(100) NOT NULL,
    start_date DATE,
    end_date DATE
);

-- Members table
CREATE TABLE members (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    trip_id INT,
    FOREIGN KEY (trip_id) REFERENCES trips(trip_id)
);

-- Expenses table
CREATE TABLE expenses (
    expense_id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    paid_by INT,
    expense_date DATE,
    trip_id INT,
    FOREIGN KEY (paid_by) REFERENCES members(member_id),
    FOREIGN KEY (trip_id) REFERENCES trips(trip_id)
);
