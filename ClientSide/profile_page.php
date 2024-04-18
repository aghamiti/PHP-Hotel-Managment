<?php
    session_start();
        $user_id = $_SESSION['user_id'];
        $dbserver = "";
        $dbuser = "";
        $dbpassword = "";
        $dbname = "";
        $conn = mysqli_connect($dbserver, $dbuser, $dbpassword, $dbname);
        if (!$conn) {
            echo 'Connection error: ' . mysqli_connect_error();
        }
        $user_id = mysqli_real_escape_string($conn, $user_id);
        $sql = "SELECT * FROM Bookings";
        $sql1 = "SELECT Price FROM Rooms";
        $result = mysqli_query($conn, $sql); //Rezultati i Bookings
        $result1 = mysqli_query($conn, $sql1); //Prices ne Rooms
        $bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $prices = mysqli_fetch_all($result1, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_free_result($result1);
        mysqli_close($conn);  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/ClientSide/Home.css ">
    <script src="https://kit.fontawesome.com/a710a530b9.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../assets/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script defer src="../assets/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

    <title>Spring Hotel &amp; Spa</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="logoja">
        <a href="index.php"><img src="../assets/images/Logo.png" alt="Logo" /></a>
    </div>
    
    <nav class="navbar">
        <div></div>
        <ul>
        <li><a href="./index.php">Home</a></li>
            <li><a href="./About-Us.html">About Us</a></li>
            <li><a href="./Contacts.html">Contacts</a></li>
            <li><a href="./FAQ.html">FAQ</a></li>
            <li><a href="./Events.php">Events</a></li>
        </ul>

        <a id="loginLink" href="profile_page.php">
        <i class="fa-solid fa-user"></i>
        </a>
        <h7 id="welcomeMessage" style="display: none;">Welcome <?php echo $username; ?></h7>
        <script>
       
            document.addEventListener("DOMContentLoaded", function() {
        
                const loginIcon = document.getElementById("loginIcon");
                const welcomeMessage = document.getElementById("welcomeMessage");

      
                function toggleElements() {
                loginIcon.style.display = (loginIcon.style.display === "none") ? "block" : "none";
                welcomeMessage.style.display = (welcomeMessage.style.display === "none") ? "block" : "none";
                }
                toggleElements(); 

        
                setTimeout(function() {
                setTimeout(toggleElements, 2000);
                }, 2000); 
            });
        </script>
    </nav>
    <footer>
        <div class="row footer-main">
            <div class="col-md-3 footer-main-opening">
                <h2>Opening Hours</h2>
                <p><span class="footer-weekendweekdays">Weekdays:</span> 8:00 AM - 8:00 PM</p>
                <p><span class="footer-weekendweekdays">Weekends:</span> 9:00 AM - 6:00 PM</p>
            </div>
            <div class="col-md-3 footer-main-adress">
                <h2>Address</h2>
                <p><span><a href="https://www.google.com/maps/search/6036+Richmond+Hwy,+Alexandria,+VA+2230/@38.7860603,-77.0740174,16.25z?entry=ttu"
                            target="_blank">
                            <address style="margin: 0;"><img src="assets\images\location.png"
                                    class="footer-location-icon">6036 Richmond Hwy, Alexandria, VA 2230</address>
                        </a></span></p>
    
                <p><img src="../assets/images/call.png" class="footer-call-icon">Call Us: <a href="tel:+1 (409) 987–5874">+1
                        (409) 987–5874</a></p>
                <a href="mailto:spring@hotel.com"><img src="../assets/images/email.png"
                        class="footer-call-icon">spring@hotel.com</a>
            </div>
            <div class="col-md-3 footer-main-newsletter">
                <h2>Join our Newsletter</h2>
            <form onsubmit="subscribeNewsletter(event)">
                <input type="email" placeholder="Enter your e-mail" required class="footer-newsletter-textfield" id="emailInput">
                <button type="submit" class="footer-newsletter-subscribebtn" id="SubscribeBtn" onclick="playAudio()">Subscribe</button>
                <audio id="SubscribeAudio" src="../assets/audio/button-click.mp3" type="audio/mp3"></audio>

                <output id="subscribeOutput" for="emailInput"></output>
            </form>

            <script>
                function subscribeNewsletter(event) {
                    event.preventDefault(); 

                    var emailInput = document.getElementById('emailInput');
                    var subscribeOutput = document.getElementById('subscribeOutput');
                    var subscribeButton = document.getElementById('SubscribeBtn');
                    const subscribeAudio = document.getElementById('SubscribeAudio');
                    if (isValidEmail(emailInput.value)) {


                        subscribeOutput.textContent = `Thank you for subscribing!`;
                        subscribeButton.style.display = 'none';


                        setTimeout(function () {
                            emailInput.value = '';
                        }, 3000);
                    } else {

                        subscribeOutput.textContent = `Please enter a valid email address.`;
                    }
                }

                function isValidEmail(email) {
                    return email.includes('@');
                }

                function playAudio() {
                    subscribeAudio.play();
                };
            </script>
            </div>
            </div>
            
        </div>
        <div class="footer-socials">
            <a href="https://www.instagram.com/" target="_blank"><img src="assets\images\instagram.png"
                    class="footer-socials-icon"></a>
            <a href="https://www.facebook.com/" target="_blank"><img src="assets\images\facebook.png"
                    class="footer-socials-icon"></a>
            <a href="https://twitter.com/" target="_blank"><img src="assets\images\twitter.png"
                    class="footer-socials-icon"></a>
        </div>
        <button id="backToTopBtn" title="Go to top" onclick="topFunciton()"><img width="30px" height="30px"
            src="../assets/images/backToTop.png" /></button>-
        <audio id="backToTopSound" src="assets\audio\whoosh.mp3" type="audio/mp3"></audio>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </footer>
</body>