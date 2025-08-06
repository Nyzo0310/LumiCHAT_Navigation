<?php
$host = "localhost";
$username = "root";
$password = ""; // leave blank if no MySQL password
$database = "db_lumichat-navigation";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
