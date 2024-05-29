<?php

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Required files
require '../Email/PHPMailer-master/src/Exception.php';
require '../Email/PHPMailer-master/src/PHPMailer.php';
require '../Email/PHPMailer-master/src/SMTP.php';

// Check if the form is submitted
if (isset($_POST["send"])) {

    // Create an instance; passing true enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                      // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                 // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                             // Enable SMTP authentication
        $mail->Username   = 'springhotel@gmail.com';           // SMTP username
        $mail->Password   = 'jbhr tcfr zmfh owth';            // SMTP password
        $mail->SMTPSecure = 'ssl';      // Enable implicit SSL encryption
        $mail->Port       = 465;                              // TCP port to connect to

        // Recipients
        $mail->addAddress($_POST['email']); 
        $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = $_POST["subject"];   // email subject headings
    $mail->Body    = $_POST["message"]; //email message

    // Success sent message alert
    $mail->send();
        echo "
        <script> 
            alert('Message was sent successfully!');
            document.location.href = 'index.php';
        </script>";
    } catch (Exception $e) {
        echo "
        <script>
            alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
        </script>";
    }
}
?>
