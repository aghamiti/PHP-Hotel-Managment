<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Signup</title>
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/ClientSide/login-signup.css">
    <style>
        .termsAndConditions-container {
            display: inline-block;
            position: relative;
            margin-bottom: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
    <form  method="post" class="form" id="loginForm" action="../API/login.php">
            <div class="logoja">
                <h1 class="form-title">Login</h1>
                <a href="./index.php"><img src="../assets/images/Logo.png" alt="Logo" /></a>
            </div>
            <div class="form-message form-message-error"></div>
            <div class="form-input-group">
                <label for="username"></label>
                <input id="username" name="username" type="text" class="form-input"  autofocus placeholder="Username or email">
                <div class="form-input-error-message"></div>
            </div>
            <div class="form-input-group">
                <label for="password"></label>
                <input type="password" name="password" id="password" class="form-input" autofocus placeholder="Password">
                <div class="form-input-error-message"></div>
            </div>
            <button type="submit" class="form-button" name="submit" >Continue</button>
            <p class="form-text">
                <a class="form-link" id="linkCreateAccount" href="signup-form.php">Don't have an account? Create account</a>
            </p>
            <p class="form-text">
                <a href="./index.php" class="form-link">Back home</a>
            </p>
        </form>

       
        </div>
    </div>

    <!-- <script src="../js/ClientSide/login-signup.js"></script> -->
</body>
</html>