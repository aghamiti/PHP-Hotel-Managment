<?php
session_start();


include_once "C:/xampp/htdocs/UEB_II_2024/API/db_connection.php";

// Check if the form is submitted for login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Define variables and initialize with empty values
    $username = $password = "";
    
    // Processing login form data when form is submitted
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    
    // Validate credentials
    if(!empty($username) && !empty($password)){
        // Prepare a select statement
        $sql = "SELECT UserID, Username, Password FROM Users WHERE Username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, start a new session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to homepage
                            header("location: C:/xampp/htdocs/UEB_II_2024/ClientSide/index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    } else {
        $login_err = "Please enter both username and password.";
    }
}

// Check if the form is submitted for signup
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    // Define variables and initialize with empty values
    $username = $email = $password = "";
    
    // Processing signup form data when form is submitted
    $username = trim($_POST["signupUsername"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Prepare an insert statement
    $sql = "INSERT INTO Users (Username, Email, Password, RegistrationDate) VALUES (?, ?, ?, NOW())";
     
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sss", $param_username, $param_email, $param_password);
        
        // Set parameters
        $param_username = $username;
        $param_email = $email;
        $param_password = $hashed_password;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Redirect user to login page
            header("location: login-signup.html");
        } else{
            echo "Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
}

// Close connection
$mysqli->close();
?>
