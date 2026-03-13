<?php
// Include the database connection (This also starts the session!)
require 'db_config.php';

// Check if the form was actually submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Grab and sanitize the email
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // We don't escape this because password_verify handles it safely

    // 2. Look for the user in the database by their email
    $sql = "SELECT id, fullname, password, role FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    // 3. Check if a user with that email exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // 4. Verify the password against the hashed password in the database
        if (password_verify($password, $user['password'])) {

            // --- SUCCESSFUL LOGIN ---
            // Set the Session Variables so the user stays logged in across pages
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];

            // Redirect the user to the correct dashboard based on their Role (RBAC Requirement)
            if ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } elseif ($user['role'] == 'trainer') {
                header("Location: trainer_dashboard.php");
            } else {
                // Default is regular gym member
                header("Location: member_dashboard.php");
            }
            exit();
        } else {
            // Password did not match
            header("Location: login.php?error=invalid");
            exit();
        }
    } else {
        // No user found with that email address
        header("Location: login.php?error=invalid");
        exit();
    }
} else {
    // Kick them out if they tried to access the file directly
    header("Location: login.php");
    exit();
}
