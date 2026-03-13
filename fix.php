<?php
require 'db_config.php';

// Generate a REAL, valid encrypted hash for the password '123'
$real_hash = password_hash('123', PASSWORD_DEFAULT);

// Update all the trainers you just added in phpMyAdmin to use this real hash
if ($conn->query("UPDATE users SET password = '$real_hash' WHERE role = 'trainer'")) {
    echo "<h2 style='color: green;'>Success! All trainer passwords are now fixed.</h2>";
    echo "<h3>The password is: <strong>123</strong></h3>";
    echo "<a href='login.php'>Click here to login</a>";
}
