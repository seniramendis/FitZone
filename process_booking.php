<?php
session_start();
require 'db_config.php';

// Security Check: Make sure they are logged in and submitted a POST request
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Grab data including the NEW trainer_name
    $user_id = $_SESSION['user_id'];
    $class_name = $conn->real_escape_string($_POST['class_name']);
    $trainer_name = $conn->real_escape_string($_POST['trainer_name']);
    $booking_date = $conn->real_escape_string($_POST['booking_date']);
    $booking_time = $conn->real_escape_string($_POST['booking_time']);

    // 2. Insert everything into database (including trainer_name)
    $sql = "INSERT INTO bookings (user_id, class_name, trainer_name, booking_date, booking_time, status) 
            VALUES ('$user_id', '$class_name', '$trainer_name', '$booking_date', '$booking_time', 'Confirmed')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to Dashboard instead of classes page to see the new booking
        header("Location: member_dashboard.php?success=booked");
        exit();
    } else {
        // Error handling
        header("Location: classes.php?error=db_error");
        exit();
    }
} else {
    header("Location: classes.php");
    exit();
}
