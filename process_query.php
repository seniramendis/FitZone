<?php
// Include the database connection
require 'db_config.php';

// Check if the form was actually submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Grab and sanitize the data to prevent SQL Injection
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    // 2. Insert the new query into the database
    // The 'status' column will automatically default to 'pending'
    $sql = "INSERT INTO queries (name, email, subject, message) 
            VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Success! Redirect back with the success flag
        header("Location: contact.php?success=1");
        exit();
    } else {
        // Catch database errors
        header("Location: contact.php?error=db_error");
        exit();
    }
} else {
    // Kick them back if they access this file directly without submitting
    header("Location: contact.php");
    exit();
}
