<?php
include 'db_connection.php'; // Database connection

session_start();

function ErrorHandler($errno, $errstr, $errfile, $errline) {
    // Customize the error messages
    switch ($errno) {
        case E_USER_ERROR:
            echo "Gabim! Numri i gabimit: [$errno] . $errstr";
            echo "Gabimi ne reshtin $errline ne file-in $errfile";
            break;
        case E_USER_WARNING:
            echo "Paralajmerim! Numri i gabimit: [$errno] . $errstr<br>";
            break;
        case E_USER_NOTICE:
            echo "<b>Vemendje: </b> [$errno] $errstr<br>";
            break;
        default:
            echo "Gabim i panjohur: [$errno] $errstr<br>";
            echo "Gabimi ne rreshtin $errline ne file-in $errfile<br>";
            break;
    }
    
    /* Don't execute PHP internal error handler */
    return true;
}

// Set the custom error handler
set_error_handler("ErrorHandler");




// Function to validate email
function validateEmail($email) {
    // Regular expression pattern for email validation
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    // Check if the email matches the pattern
    return preg_match($pattern, $email);
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
        trigger_error("Username eshte obligativ te plotesohet!", E_USER_ERROR);
        exit();
    }elseif(strlen($username)<=3){
        trigger_error("Gjatesia e username duhet te jete me e madhe se 3. Shkruaj perseri.", E_USER_NOTICE);
        exit();
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
