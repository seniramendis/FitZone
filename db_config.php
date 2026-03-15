<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "fitzone_db";


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
