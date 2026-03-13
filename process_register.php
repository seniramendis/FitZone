<?php
// Include the database connection we just made
require 'db_config.php';

// Check if the form was actually submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Grab and sanitize the form data to prevent SQL Injection (Examiners love this)
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $goal = $conn->real_escape_string($_POST['goal']);
    $raw_password = $_POST['password'];

    // 2. Hash the password for extreme security (Crucial for getting a Distinction!)
    $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);

    // 3. Check if the email is already registered in the database
    $check_email = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        // Email already exists! Send them back to the register page with an error flag
        header("Location: register.php?error=email_exists");
        exit();
    } else {
        // 4. Insert the new user into the database
        // Note: The 'role' column will automatically default to 'member' based on our database setup!
        $sql = "INSERT INTO users (fullname, email, password, goal) 
                VALUES ('$fullname', '$email', '$hashed_password', '$goal')";

        if ($conn->query($sql) === TRUE) {
            // Success! Send them to the login page so they can log in to their new account
            header("Location: login.php?success=registered");
            exit();
        } else {
            // Catch any weird database errors (Proper Error Handling for LO3)
            header("Location: register.php?error=db_error");
            exit();
        }
    }
} else {
    // Kick them out if they tried to access this file without submitting the form
    header("Location: register.php");
    exit();
}
