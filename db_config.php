<?php
// Database configuration settings
$host = "localhost";      // Usually 'localhost' if using XAMPP/WAMP
$username = "root";       // Default XAMPP username
$password = "";           // Default XAMPP password is empty
$database = "fitzone_db"; // The name of the database we just created

// Create the MySQL connection
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection failed
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Start the session (Crucial for keeping users logged in across pages)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
