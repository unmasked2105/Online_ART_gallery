<?php
$servername = "localhost";
$username = "root"; 
$password = "1210"; 
$dbname = "online_art_gallery"; 

// connection created
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
