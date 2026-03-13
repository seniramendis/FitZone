<?php
session_start();
require 'db_config.php';

// Security check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];

    // Grab the plan name they selected (e.g., 'Pro' or 'VIP')
    $new_plan = $conn->real_escape_string($_POST['plan_name']);

    // Determine the price based on the plan
    $amount = 0;
    if ($new_plan == 'Pro') $amount = 5500;
    if ($new_plan == 'VIP') $amount = 10000;

    // 1. Update the database for their subscription plan!
    $sql = "UPDATE users SET subscription_plan = '$new_plan' WHERE id = '$user_id'";

    if ($conn->query($sql) === TRUE) {

        // 2. SAVE THE RECEIPT INTO THE PAYMENTS TABLE!
        if ($amount > 0) {
            $transaction_name = "Subscription Upgrade ($new_plan)";
            $conn->query("INSERT INTO payments (user_id, amount, transaction_type) VALUES ('$user_id', '$amount', '$transaction_name')");
        }

        // Send them back to the dashboard with a success message
        header("Location: member_dashboard.php?success=upgraded");
        exit();
    } else {
        echo "Error saving subscription: " . $conn->error;
    }
} else {
    header("Location: pricing.php");
    exit();
}
