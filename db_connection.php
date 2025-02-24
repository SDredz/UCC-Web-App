<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ucc_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>