<?php
// Database connection using MySQLi
$host = "localhost";
$user = "root"; // default XAMPP user
$pass = "Surya@123";     // default XAMPP password is empty
$dbname = "roammates";

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
