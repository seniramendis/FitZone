<?php
session_start();
require 'db_config.php';

// Security Check: Only allow logged-in trainers to update statuses
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'trainer') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grab the ID of the specific booking
    $booking_id = $conn->real_escape_string($_POST['booking_id']);

    // Update the booking status from Pending to Confirmed
    $sql = "UPDATE bookings SET status = 'Confirmed' WHERE id = '$booking_id'";

    if ($conn->query($sql) === TRUE) {
        // Send the trainer back to their dashboard with a success message
        header("Location: trainer_dashboard.php?success=confirmed");
        exit();
    } else {
        header("Location: trainer_dashboard.php?error=db");
        exit();
    }
} else {
    header("Location: trainer_dashboard.php");
    exit();
}
