<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Required files
require '../Email/PHPMailer-master/src/Exception.php';
require '../Email/PHPMailer-master/src/PHPMailer.php';
require '../Email/PHPMailer-master/src/SMTP.php';

// Check if the form is submitted
if (isset($_POST["send"])) {
    // Sanitize input
    $subject = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Create an instance; passing true enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                      // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                 // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                             // Enable SMTP authentication
        $mail->Username   = 'springhotel2024@gmail.com';          // SMTP username
        $mail->Password   = 'jbhr tcfr zmfh owth';              // SMTP password (use App Password if 2FA is enabled)
        $mail->SMTPSecure = 'tls';                            // Enable explicit TLS encryption
        $mail->Port       = 587;                              // TCP port to connect to

        // Recipients
        $mail->setFrom('springhotel@gmail.com', 'Spring Hotel');  // Sender's email address and name
        $mail->addAddress($email);                      // Recipient's email address
        $mail->isHTML(true);                                     // Set email format to HTML

        // Email content
        $mail->Subject = 'Received message - ' . $subject;   // Email subject
        $mail->Body    = 'Dear Customer,<br><br>We are currently working on a response to your inquiry submitted through our webpage. Thank you for reaching out to us.<br><br>Best regards,<br>Spring Hotel';  // Email body

        // Send email
        $mail->send();
        echo "
        <script> 
            alert('Message was sent successfully!');
            document.location.href = 'index.php';
        </script>";
    } catch (Exception $e) {
        // Log the error or handle it more gracefully
        echo "
        <script>
            alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
            window.history.back();
        </script>";
    }
}
?>
