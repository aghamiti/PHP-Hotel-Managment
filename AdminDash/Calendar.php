<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <title>Spring Hotel | Calendar | Admin</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.0.2-dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../css/AdminDash/Calendar.css">
</head>
<body>
    <div class="logoja">
        <a href="../ClientSide/index.php"><img src="../assets/images/Logo.png" alt="Logo" /></a>
    </div>

    <nav class="navbar">
        <div></div>
        <ul>
            <li><a href="./Calendar.php">Calendar</a></li>
            <li><a href="./Messages.php">Inbox</a></li>
            <li><a href="./Reservations.php">Reservations</a></li>
        </ul>
        <a href="../ClientSide/login-signup.php">
            <img src="../assets/images/login-icon.png" alt="login-icon">
        </a>
    </nav>

    <header class="header">
        <h1>Calendar</h1>
    </header>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="calendar">
                    <div class="calendar-header">
                        <h2>April 2024</h2>
                    </div>
                    <div class="calendar-body">
                        <div class="row">
                            <div class="col day text-center">
                                <h4>1</h4>
                                <div class="booked"></div>
                            </div>
                            <div class="col day text-center">
                                <h4>2</h4>
                                <div class="available"></div>
                            </div>
                            <div class="col day text-center">
                                <h4>2</h4>
                                <div class="available"></div>
                            </div>
                            <div class="col day text-center">
                                <h4>2</h4>
                                <div class="available"></div>
                            </div>
                            <!-- More days here -->
                            <!-- You can dynamically generate these divs using JavaScript -->
                        </div>
                        <div class="row">
                            <div class="col day text-center">
                                <h4>1</h4>
                                <div class="booked"></div>
                            </div>
                            <div class="col day text-center">
                                <h4>2</h4>
                                <div class="available"></div>
                            </div>
                            <div class="col day text-center">
                                <h4>2</h4>
                                <div class="available"></div>
                            </div>
                            <div class="col day text-center">
                                <h4>2</h4>
                                <div class="available"></div>
                            </div>
                            <!-- More days here -->
                            <!-- You can dynamically generate these divs using JavaScript -->
                        </div>
                        <div class="row">
                            <div class="col day text-center">
                                <h4>1</h4>
                                <div class="booked"></div>
                            </div>
                            <div class="col day text-center">
                                <h4>2</h4>
                                <div class="available"></div>
                            </div>
                            <div class="col day text-center">
                                <h4>2</h4>
                                <div class="available"></div>
                            </div>
                            <div class="col day text-center">
                                <h4>2</h4>
                                <div class="available"></div>
                            </div>
                            <!-- More days here -->
                            <!-- You can dynamically generate these divs using JavaScript -->
                        </div>
                        <div class="row">
                            <div class="col day text-center">
                                <h4>1</h4>
                                <div class="booked"></div>
                            </div>
                            <div class="col day text-center">
                                <h4>2</h4>
                                <div class="available"></div>
                            </div>
                            <div class="col day text-center">
                                <h4>2</h4>
                                <div class="available"></div>
                            </div>
                            <div class="col day text-center">
                                <h4>2</h4>
                                <div class="available"></div>
                            </div>
                            <!-- More days here -->
                            <!-- You can dynamically generate these divs using JavaScript -->
                        </div>
                        <!-- More rows here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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
                            <address style="margin: 0;"><img src="../assets/images/location.png"
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
            <a href="https://www.instagram.com/" target="_blank"><img src="../assets/images/instagram.png"
                    class="footer-socials-icon"></a>
            <a href="https://www.facebook.com/" target="_blank"><img src="../assets/images/facebook.png"
                    class="footer-socials-icon"></a>
            <a href="https://twitter.com/" target="_blank"><img src="../assets/images/twitter.png"
                    class="footer-socials-icon"></a>
        </div>
    </footer>         
    
    <button id="backToTopBtn" title="Go to top" onclick="topFunciton()"><img width="30px" height="30px"
            style="display: flex; align-items: center; justify-content: center;"
            src="../assets/images/backToTop.png" /></button>
    <audio id="backToTopSound" src="../assets/audio/whoosh.mp3" type="audio/mp3"></audio>
<script src="../js/ClientSide/About-Us.js"></script>
<script src="../assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>