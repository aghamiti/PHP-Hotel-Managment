<?php
// Include your database connection file
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];

    // Regular expression pattern for email validation
    $email_pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    // Validate email using Regex
    if (!preg_match($email_pattern, $email)) {
        echo "Please enter a valid email address.";
    } else {
        // Email is valid, proceed with further actions

        // Insert email into the database
        $sql = "INSERT INTO NewsletterSubscribers (Email, SubscriptionDate) VALUES ('$email', NOW())";
        if (mysqli_query($conn, $sql)) {
            echo "Thank you for subscribing to our newsletter!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>
