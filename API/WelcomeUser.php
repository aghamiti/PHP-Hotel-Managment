<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the username is set and not empty
    if (isset($_POST['username']) && !empty($_POST['username'])) {
        // Set the username in the session
        $_SESSION['username'] = $_POST['username'];
        
        // Redirect to the homepage
        header("Location: ../ClientSide/index.php");
        exit();
    } else {
        // Handle invalid username (optional)
        echo "Invalid username";
    }
}
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";

?>
