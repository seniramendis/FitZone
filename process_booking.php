<?php
session_start();
require 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $class_name = $conn->real_escape_string($_POST['class_name']);
    $trainer_name = $conn->real_escape_string($_POST['trainer_name']);
    $booking_date = $conn->real_escape_string($_POST['booking_date']);
    $booking_time = $conn->real_escape_string($_POST['booking_time']);

    // 1. Insert the booking
    $sql = "INSERT INTO bookings (user_id, class_name, trainer_name, booking_date, booking_time, status) 
            VALUES ('$user_id', '$class_name', '$trainer_name', '$booking_date', '$booking_time', 'Pending')";

    if ($conn->query($sql) === TRUE) {

        // 2. RECORD THE SERVICE PAYMENT!
        $service_fee = 2000;
        $transaction_name = "Trainer Service: $trainer_name ($class_name)";
        $conn->query("INSERT INTO payments (user_id, amount, transaction_type) VALUES ('$user_id', '$service_fee', '$transaction_name')");

        header("Location: member_dashboard.php?success=booked");
        exit();
    } else {
        header("Location: classes.php?error=db_error");
        exit();
    }
} else {
    header("Location: classes.php");
    exit();
}
