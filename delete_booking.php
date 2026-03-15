<?php
session_start();
require 'db_config.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $conn->real_escape_string($_POST['booking_id']);

    // Delete query
    $sql = "DELETE FROM bookings WHERE id = '$booking_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php?success=deleted");
    } else {
        header("Location: admin_dashboard.php?error=db");
    }
} else {
    header("Location: admin_dashboard.php");
}
exit();
