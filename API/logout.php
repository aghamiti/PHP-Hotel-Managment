// logout.php
<?php
session_start();
unset($_SESSION['login_user']); // Unset the username
session_destroy(); // Destroy all session data
header("Location: ../ClientSide/login-signup.php"); // Redirect to the login page
exit;
?>
