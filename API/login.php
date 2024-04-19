<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

include 'db_connection.php'; // Include your DB connection
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = $_POST['password']; // Password from form, not yet sanitized because we hash it

    // Prepare a select statement
    $stmt = $mysqli->prepare("SELECT UserID, Password FROM Users WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Check if the password is correct
        if (password_verify($password, $user['Password'])) {
            // Password is correct, so start a new session
            $_SESSION['login_user'] = $username;
            $_SESSION['user_id'] = $user['UserID'];
            header("location: ../ClientSide/index.php"); // Redirect to home page
            exit;
        } else {
            // Password is not valid
            $_SESSION['login_error'] = "Your Login Name or Password is invalid";
            header("location: ../ClientSide/login.php"); // Redirect back to the login page
            exit;
        }
    } else {
        // Username doesn't exist
        $_SESSION['login_error'] = "Your Login Name or Password is invalid";
        header("location: ../ClientSide/login.php"); // Redirect back to the login page
        exit;
    }
    $stmt->close();
}
?>
