
<?php

$servername = "147.175.98.159";
$username = "mojuser";
$password = "mojpassword";
$dbname = "zadanie4";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 

$conn->set_charset("utf8");

?>