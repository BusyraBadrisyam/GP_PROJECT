<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "knicks";

$conn = new mysqli($servername, $username, $password, $database);
date_default_timezone_set('Asia/Kuala_Lumpur'); // Adjust based on your timezone

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("SET time_zone = '+08:00';"); // MySQL timezone

?>
