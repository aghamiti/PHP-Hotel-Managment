<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

include 'db_connection.php'; // Ensure the correct database connection file and variable
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']); // Use $conn if that's your db connection variable
    $password = $_POST['password']; // Get password from form

    // Prepare a select statement
    $stmt = $conn->prepare("SELECT UserID, Password FROM Users WHERE Username = ? OR Email = ?"); // Allows login with username or email
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Check if the password is correct
        if (password_verify($password, $user['Password'])) {
            // Password is correct, so start a new session and set the user
            $_SESSION['login_user'] = $username;
            $_SESSION['user_id'] = $user['UserID'];
            header("location: ../ClientSide/index.php"); // Redirect to home page
            exit;
        } else {
            // Password is not valid, set an error message
            $_SESSION['login_error'] = "Invalid Username or Password.";
            header("location: ../ClientSide/login.php"); // Redirect back to the login page
            exit;
        }
    } else {
        // Username doesn't exist
        $_SESSION['login_error'] = "Invalid Username or Password.";
        header("location: ../ClientSide/login.php"); // Redirect back to the login page
        exit;
    }
    $stmt->close();
}
?>
