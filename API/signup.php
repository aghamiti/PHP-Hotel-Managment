<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

include 'db_connection.php'; // Include your DB connection

session_start(); // Start the session if you plan to use it


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($mysqli, $_POST['signupUsername']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']); // Get the password from POST
    $password_hashed = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $newsletter = isset($_POST['newsletter-option']) && $_POST['newsletter-option'] == 'Yes' ? 1 : 0;

    // Use prepared statements for security
    $stmt = $mysqli->prepare("INSERT INTO Users (Username, Email, Password, NewsletterSubscription, RegistrationDate) VALUES (?, ?, ?, ?, CURDATE())");
    $stmt->bind_param("sssi", $username, $email, $password_hashed, $newsletter);

    if ($stmt->execute()) { // Execute the prepared statement
        $_SESSION['signup_success'] = "New record created successfully";
        // header("location: ../ClientSide/index.php"); // Redirect to homepage
        echo "Hello there";
        exit;
    } else {
        $_SESSION['signup_error'] = "Error creating account. Please try again.";
        header("location: ../ClientSide/signup.php"); // Redirect to signup page
        exit;
    }
}
?>
