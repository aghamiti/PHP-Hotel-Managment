<?php 
function sortTotalPayment($a, $b) {
    $paymentA = intval(str_replace(['&euro;', ','], ['', ''], $a['TotalPayment']));
    $paymentB = intval(str_replace(['&euro;', ','], ['', ''], $b['TotalPayment']));
    return $paymentA <=> $paymentB;
}

    session_start();
        include_once '../API/db_connection.php';//Including the connection to the database

        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

        $user_id = mysqli_real_escape_string($conn, $user_id);

        $sql = "SELECT * FROM Bookings WHERE UserID='$user_id'"; //Query nderrohet kur funksionalizohen dhe nderrohen pjeset tjera
        $sql1 = "SELECT Price FROM Rooms";  

        $result = mysqli_query($conn, $sql); 
        $result1 = mysqli_query($conn, $sql1); 

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
    <style>
        .atributet{
            font-size: 19px;
            font-family: 'Poppins';
            font-style: oblique;
            color: #8f859e;
        }
        .atributet1{
            color: black;
        }
        .heading2{
            text-align: center; 
            font-family: 'Poppins'; 
            font-size:35px;
            color: black;
        }
        .butonat{
            text-align: center;
            text-decoration: none;
        }
        .butonat:hover{
            color: #8f859e;
        }
    </style>
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
    <div class="carousel-container">
    <div class="dashboard">
        <br>
        <table><h1 style="text-align: center; color:black; font-family: 'Poppins'">Your Reservation Dashboard</h1></table>
        <br>
        <div class="row">
            <div class="row">
                <div class="col-md-12 butonat">
                    <?php
                        echo "<form method='GET'>";
                        echo "<button type='submit' name='sort' value='asc_payment' class='butonat'>"?><i class="fa-solid fa-sort-up"></i>
                    <?php
                        echo "<button type='submit' name='sort' value='desc_payment' class='butonat'>";?><i class="fa-solid fa-sort-down"></i><?php
                        echo "</form>";
                        echo "<br>";
                    ?>
                </div>
            </div>
<?php
            foreach ($bookings as &$booking) {
            $checkInDate = strtotime($booking['CheckInDate']);
            $checkOutDate = strtotime($booking['CheckOutDate']);
            $numberOfNights = ceil(($checkOutDate - $checkInDate) / (60 * 60 * 24)); // Calculate the number of nights stayed
            $totalPayment = $numberOfNights * $prices[0]['Price']; // Calculate the total payment
            $booking['TotalPayment'] = $totalPayment;
        }
            unset($booking);

        if (isset($_GET['sort'])) {
            if ($_GET['sort'] == 'asc_payment') {
                usort($bookings, 'sortTotalPayment');
            } elseif ($_GET['sort'] == 'desc_payment') {
                usort($bookings, function($a, $b) {
                return $b['TotalPayment'] <=> $a['TotalPayment'];
                });
            }   
        }
?>
?>
            <div class="col-md-1"></div>
            <div id="doneReservations" class="col-md-5 background-light">
                <h2  class="heading2">Past Reservations</h2>
                <?php foreach ($bookings as $booking) {
                        $checkOutDate = strtotime($booking['CheckOutDate']);
                        if ($checkOutDate < time()) { 
                            $checkInDate = strtotime($booking['CheckInDate']);
                            $numberOfNights = ceil(($checkOutDate - $checkInDate) / (60 * 60 * 24)); // Calculate the number of nights stayed
                            $totalPayment = $numberOfNights * $prices[0]['Price']; // Calculate the total payment ?>
                        <hr>
                            <p class="atributet"><strong class="atributet1">Guest name:</strong> <?php echo $booking['GuestName']; ?></p>
                            <p class="atributet"><strong class="atributet1">Booking number:</strong> <?php echo $booking['BookingID']; ?></p>
                            <p class="atributet"><strong class="atributet1">Check-in:</strong> <?php echo $booking['CheckInDate']; ?></p>
                            <p class="atributet"><strong class="atributet1">Check-out:</strong> <?php echo $booking['CheckOutDate']; ?></p>
                            <p class="atributet"><strong class="atributet1">Adults:</strong> <?php echo $booking['Adults']; ?></p>
                            <p class="atributet"><strong class="atributet1">Children:</strong> <?php echo $booking['Children']; ?></p>
                            <p class="atributet"><strong class="atributet1">Total payment:</strong> <?php echo $totalPayment;?>&euro;</p>
                        <hr>
                    <?php }
                } ?>
            </div>
            
            <div id="upcomingReservations" class="col-md-5 background-light">
                <h2 class="heading2">Upcoming Reservations</h2>
                <?php foreach ($bookings as $booking) {
                    
                        $checkOutDate = strtotime($booking['CheckOutDate']);
                        if ($checkOutDate >= time()) { 
                            $checkInDate = strtotime($booking['CheckInDate']);
                            $numberOfNights = ceil(($checkOutDate - $checkInDate) / (60 * 60 * 24)); // Calculate the number of nights stayed
                            $totalPayment = $numberOfNights * $prices[0]['Price']; // Calculate the total payment ?>
                        <hr>
                            <p class="atributet"><strong class="atributet1">Guest name:</strong> <?php echo $booking['GuestName']; ?></p>
                            <p class="atributet"><strong class="atributet1">Booking number:</strong> <?php echo $booking['BookingID']; ?></p>
                            <p class="atributet"><strong class="atributet1">Check-in:</strong> <?php echo $booking['CheckInDate']; ?></p>
                            <p class="atributet"><strong class="atributet1">Check-out:</strong> <?php echo $booking['CheckOutDate']; ?></p>
                            <p class="atributet"><strong class="atributet1">Adults:</strong> <?php echo $booking['Adults']; ?></p>
                            <p class="atributet"><strong class="atributet1">Children:</strong> <?php echo $booking['Children']; ?></p>
                            <p class="atributet"><strong class="atributet1">Total payment:</strong> <?php echo $totalPayment;?>&euro;</p>
                        <hr>
                    <?php }
                } ?>
            </div>
            
            <div class="col-md-1"></div>
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
        <form id="newsletterForm" method="post" action="../API/newsletter.php" onsubmit="subscribeNewsletter(event)">
            <input type="email" name="email" placeholder="Enter your e-mail" required class="footer-newsletter-textfield" id="emailInput">
            <?php if ($_SESSION['form_submissions'] == 0 && !isset($_SESSION['submit_disabled'])) { ?>
                <button type="submit" class="footer-newsletter-subscribebtn" id="subscribeBtn" onclick="playAudio()">Subscribe</button>
            <?php } ?>
            <audio id="subscribeAudio" src="../assets/audio/button-click.mp3" type="audio/mp3"></audio>
            <output id="subscribeOutput" for="emailInput"></output>
        </form>

            <script>
            window.onload = function() {
                var formSubmissions = <?php echo $_SESSION['form_submissions']; ?>;
                sessionStorage.setItem('formSubmissions', formSubmissions);

            if (sessionStorage.getItem('submitDisabled')) {
                document.getElementById('SubscribeBtn').style.display = 'none';
                document.getElementById('subscribeOutput').textContent = "You're already subscribed.";
            }
        };

            function subscribeNewsletter(event) {
                event.preventDefault();

                var form = document.getElementById('newsletterForm');
                var formData = new FormData(form);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../API/newsletter.php', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Handle successful response
                            var response = xhr.responseText;
                            var subscribeOutput = document.getElementById('subscribeOutput');
                            subscribeOutput.textContent = response;
                            form.reset();
                        } else {
                            // Handle error response
                            console.error('Error:', xhr.status);
                        }
                    }
                };
                xhr.send(formData);
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
<script src="../assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
