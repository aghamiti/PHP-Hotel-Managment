<?php
$servername = "localhost";
$username = "root"; // Ndrroni me t'juajat nese e provoni se me shume gjase sju bon
$password = "1234"; // Ndrroni me t'juajat nese e provoni se me shume gjase sju bon
$dbname = "hotel_database"; 


$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
