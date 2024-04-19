<?php
$servername = "localhost";
$username = "root"; // Ndrroni me t'juajat nese e provoni se me shume gjase sju bon
$password = "root1234"; // Ndrroni me t'juajat nese e provoni se me shume gjase sju bon
$dbname = "hotel_database"; 


$mysqli = new mysqli($servername, $username, $password, $dbname);


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
