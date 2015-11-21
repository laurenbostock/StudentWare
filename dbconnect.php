<?php
$servername = "localhost";
$username = "root";
$password = "Ruby_Wire323846";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
