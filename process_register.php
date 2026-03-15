<?php

require 'db_config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $goal = $conn->real_escape_string($_POST['goal']);
    $raw_password = $_POST['password'];


    $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);


    $check_email = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {

        header("Location: register.php?error=email_exists");
        exit();
    } else {

        $sql = "INSERT INTO users (fullname, email, password, goal) 
                VALUES ('$fullname', '$email', '$hashed_password', '$goal')";

        if ($conn->query($sql) === TRUE) {

            header("Location: login.php?success=registered");
            exit();
        } else {

            header("Location: register.php?error=db_error");
            exit();
        }
    }
} else {

    header("Location: register.php");
    exit();
}
