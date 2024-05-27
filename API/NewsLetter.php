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
        // Insert email into the database
        $sql = "INSERT INTO NewsLetterSubscribers (Email, SubscriptionDate) VALUES ('$email', NOW())";
        if (mysqli_query($conn, $sql)) {
            $subject = "Confirmation Email";
            $message = "Thank you for subscribing to our newsletter!";
            $headers = "From: springhotel2024@gmail.com";

            if(mail('$email',$subject,$message,$headers)){
                echo "<br> Email sent! <br>";
            }else{
                echo "<br> Email not sent! <br>";
            }



            // echo "Thank you for subscribing to our newsletter! <br>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

?>
