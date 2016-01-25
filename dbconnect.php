<?php
$servername = "selene.hud.ac.uk/studentware/";
$username = "studentware";
$password = "ac43shopPC";
// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
