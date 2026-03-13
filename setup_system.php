<?php
require 'db_config.php';

echo "<div style='font-family: Arial, sans-serif; padding: 40px; line-height: 1.6;'>";
echo "<h2 style='color: #e63946;'>FitZone Database Synchronization</h2>";

// 1. ADD 'trainer_name' TO BOOKINGS TABLE
$check_column = $conn->query("SHOW COLUMNS FROM bookings LIKE 'trainer_name'");
if ($check_column->num_rows == 0) {
    if ($conn->query("ALTER TABLE bookings ADD COLUMN trainer_name VARCHAR(100) AFTER class_name")) {
        echo "<p>✅ Updated <strong>bookings</strong> table to support Trainer Names.</p>";
    }
} else {
    echo "<p>✔️ <strong>bookings</strong> table is already up to date.</p>";
}

// 2. DEFAULT PASSWORDS
$trainer_password = password_hash('Trainer@123', PASSWORD_DEFAULT);
$admin_password = password_hash('Admin@123', PASSWORD_DEFAULT);

// 3. CREATE ADMIN ACCOUNT
$check_admin = $conn->query("SELECT id FROM users WHERE email = 'admin@fitzone.lk'");
if ($check_admin->num_rows == 0) {
    $conn->query("INSERT INTO users (fullname, email, password, role) VALUES ('System Admin', 'admin@fitzone.lk', '$admin_password', 'admin')");
    echo "<p>✅ Added Admin Account: <strong>admin@fitzone.lk</strong></p>";
}

// 4. CREATE TRAINER ACCOUNTS
$trainers = [
    ['Nuwan Perera', 'nuwan@fitzone.lk'],
    ['Dilani Silva', 'dilani@fitzone.lk'],
    ['Kavindu Jayawardena', 'kavindu@fitzone.lk'],
    ['Senuri Fernando', 'senuri@fitzone.lk'],
    ['Roshan Silva', 'roshan@fitzone.lk'],
    ['Malith Kumara', 'malith@fitzone.lk']
];

echo "<hr><h3>Setting up Trainers:</h3>";

foreach ($trainers as $t) {
    $name = $t[0];
    $email = $t[1];

    $check = $conn->query("SELECT id FROM users WHERE email = '$email'");
    if ($check->num_rows == 0) {
        $conn->query("INSERT INTO users (fullname, email, password, role) VALUES ('$name', '$email', '$trainer_password', 'trainer')");
        echo "<p style='color: green;'>✅ Added Trainer: <strong>$name</strong> ($email)</p>";
    } else {
        echo "<p style='color: gray;'>✔️ Trainer <strong>$name</strong> already exists.</p>";
    }
}

echo "<hr><h3 style='color: #111827;'>System Ready!</h3>";
echo "<p><strong>Trainer Password:</strong> Trainer@123</p>";
echo "<p><strong>Admin Password:</strong> Admin@123</p>";
echo "<p><a href='login.php' style='display: inline-block; padding: 10px 20px; background: #e63946; color: #fff; text-decoration: none; border-radius: 5px;'>Go to Login Page</a></p>";
echo "</div>";
