<?php
require 'db_config.php';

// 1. Force the database column to accept the word 'Pending'
$conn->query("ALTER TABLE bookings MODIFY COLUMN status ENUM('Pending', 'Confirmed', 'Waitlist', 'Cancelled') DEFAULT 'Pending'");

// 2. Change every single booking in the system to 'Pending'
if ($conn->query("UPDATE bookings SET status = 'Pending'")) {
    echo "<div style='text-align: center; margin-top: 50px; font-family: sans-serif;'>";
    echo "<h1 style='color: #2ecc71;'>✅ Database Successfully Fixed!</h1>";
    echo "<h3>All classes have been reset to 'Pending'.</h3>";
    echo "<a href='trainer_dashboard.php' style='display: inline-block; margin-top: 20px; padding: 15px 30px; background: #e63946; color: white; text-decoration: none; border-radius: 10px; font-weight: bold;'>Go to Trainer Dashboard</a>";
    echo "</div>";
} else {
    echo "<h1>Database Error: " . $conn->error . "</h1>";
}
