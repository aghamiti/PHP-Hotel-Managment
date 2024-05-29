<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST['name'];
    $phoneNumber = $_POST['numbers'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    $email = $_POST['email'];

    // Regex for splitting phone numbers
    $phoneRegex = '/(\d{3})(\d{3})(\d{4})/';
    if (preg_match($phoneRegex, $phoneNumber, $matches)) {
        $phoneNumber = $matches[1] . '-' . $matches[2] . '-' . $matches[3];
    }
?>
