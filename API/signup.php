<?php
include 'db_connection.php'; // Database connection

session_start();

// Function to validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password
function validatePassword($password) {
    // Password must contain at least 8 characters, one special character, one uppercase, and one lowercase letter
    return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    $username = mysqli_real_escape_string($conn, $_POST['signupUsername']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $newsletter = isset($_POST['newsletter-option']) && $_POST['newsletter-option'] == 'Yes' ? 1 : 0;

    // Determine user role based on email domain
    $userRole = (substr($email, -strlen("@spring.hotel.com")) === "@spring.hotel.com") ? 'admin' : 'client';

    // Array for collecting errors
    $errors = [];

    if (empty($username)) {
        $errors["signupUsername"] = "Username is required";
    }

    if (empty($email)) {
        $errors["email"] = "Email address is required";
    } elseif (!validateEmail($email)) {
        $errors["email"] = "Invalid email address format";
    }

    if (empty($password)) {
        $errors["password"] = "Password is required";
    } elseif (!validatePassword($password)) {
        $errors["password"] = "Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one special character";
    }

    if (empty($errors)) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        // Use prepared statements for security
        $stmt = $conn->prepare("INSERT INTO Users (Username, Email, Password, NewsletterSubscription, UserRole, RegistrationDate) VALUES (?, ?, ?, ?, ?, CURDATE())");
        $stmt->bind_param("sssis", $username, $email, $password_hashed, $newsletter, $userRole);

        if ($stmt->execute()) {
            echo "success"; // Return success message
        } else {
            echo "Error creating account. Please try again.";
        }
    } else {
        // Errors found, return them as JSON
        echo json_encode($errors);
    }
}
?>
