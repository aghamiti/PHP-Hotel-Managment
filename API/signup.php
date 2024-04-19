<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
echo("Redirected successfully ");
include 'db_connection.php'; // Include your DB connection
echo("working");
session_start(); // Start the session if you plan to use it

// Function to validate email address using RegEx
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
echo("echo");
// Function to validate password using RegEx
function validatePassword($password) {
    // Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one special character
    return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password);
}
echo ($_SERVER["REQUEST_METHOD"]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($mysqli, $_POST['signupUsername']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $newsletter = isset($_POST['newsletter-option']) && $_POST['newsletter-option'] == 'Yes' ? 1 : 0;

    // Perform validation
    $errors = [];

    // Validate username (you can add more rules if needed)
    if (empty($username)) {
        $errors["signupUsername"] = "Username is required";
    }

    // Validate email address
    if (empty($email)) {
        $errors["email"] = "Email address is required";
    } elseif (!validateEmail($email)) {
        $errors["email"] = "Invalid email address format";
    }

    // Validate password
    if (empty($password)) {
        $errors["password"] = "Password is required";
    } elseif (!validatePassword($password)) {
        $errors["password"] = "Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one special character";
    }

    // Check if there are any errors
    if (empty($errors)) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        // Use prepared statements for security
        $stmt = $mysqli->prepare("INSERT INTO Users (Username, Email, Password, NewsletterSubscription, RegistrationDate) VALUES (?, ?, ?, ?, CURDATE())");
        $stmt->bind_param("sssi", $username, $email, $password_hashed, $newsletter);

        if ($stmt->execute()) { // Execute the prepared statement
            $_SESSION['signup_success'] = "New record created successfully";
            header("location: ../ClientSide/index.php"); // Redirect to homepage
            exit;
        } else {
            $_SESSION['signup_error'] = "Error creating account. Please try again.";
            header("location: ../ClientSide/signup-form.php"); // Redirect to signup page
            exit;
        }
    } else {
        // Errors found, store them in session and redirect back to signup page
        $_SESSION['signup_errors'] = $errors;
        header("location: ../ClientSide/signup-form.php"); // Redirect to signup page
        exit;
    }
}
?>
