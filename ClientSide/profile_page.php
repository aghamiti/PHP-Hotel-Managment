<?php 
function sortTotalPayment($a, $b) {
    $paymentA = intval(str_replace(['&euro;', ','], ['', ''], $a['TotalPayment']));
    $paymentB = intval(str_replace(['&euro;', ','], ['', ''], $b['TotalPayment']));
    return $paymentA <=> $paymentB;
}
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
    </nav>
    <div class="carousel-container">
    <div class="dashboard">
        <br>
        <table><h1 style="text-align: center; color:black; font-family: 'Poppins'">Reservation Dashboard</h1></table>
        <br>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <h2  class="heading2">Past Reservations</h2>
                <br>
            </div>
            <div class="col-md-5">
                <h2 class="heading2">Upcoming Reservations</h2>
                <br>
            </div>
            <div class="col-md-1"></div>
        </div>
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
        <div class="row">
            <div class="col-md-1"></div>
            <div id="doneReservations" class="col-md-5 background-light">
                <?php
                $doneReservations = [
                        '1' => [
                            'GuestName' => "James Bond",
                            'BookingID' => 1001,
                            'CheckInDate' => "2023-12-20",
                            'CheckOutDate' => "2023-12-25",
                            'Adults' => 2,
                            'Children' => 1,
                            'TotalPayment' => "750&euro;"
                        ],

                        '2' => [
                            'GuestName' => "James Bond",
                            'BookingID' => 1002,
                            'CheckInDate' => "2024-01-05",
                            'CheckOutDate' => "2024-01-10",
                            'Adults' => 1,
                            'Children' => 0,
                            'TotalPayment' => "500&euro;"
                        ],

                        '3' => [
                            'GuestName' => "James Bond",
                            'BookingID' => 1003,
                            'CheckInDate' => "2024-02-15",
                            'CheckOutDate' => "2024-02-20",
                            'Adults' => 2,
                            'Children' => 2,
                            'TotalPayment' => "1100&euro;"
                        ]
                    ];
                    
                    
                    if (isset($_GET['sort'])) {
                        $sortOrder = $_GET['sort'];
                        if ($sortOrder === 'asc_payment') {
                            uasort($doneReservations, 'sortTotalPayment');
                        } elseif ($sortOrder === 'desc_payment') {
                            uasort($doneReservations, 'sortTotalPayment');
                            $doneReservations = array_reverse($doneReservations);
                        }
                    }
                    foreach ($doneReservations as $reservation) {
                        echo "<hr>";
                        echo "<strong>Guest name:</strong> " . $reservation['GuestName'] . "<br>";
                        echo "<strong>Booking ID:</strong> " . $reservation['BookingID'] . "<br>";
                        echo "<strong>CheckInDate:</strong> " . $reservation['CheckInDate'] . "<br>";
                        echo "<strong>CheckOutDate:</strong> " . $reservation['CheckOutDate'] . "<br>";
                        echo "<strong>Adults:</strong> " . $reservation['Adults'] . "<br>";
                        echo "<strong>Children:</strong> " . $reservation['Children'] . "<br>";
                        echo "<strong>TotalPayment:</strong> " . $reservation['TotalPayment'] . "<br>";
                        echo "<hr>";
                    }
      
                ?>
                
                
            </div>
            <div id="upcomingReservations" class="col-md-5 background-light">
                <?php
                    $upcomingReservations = [
                        '1' => [
                            'GuestName' => "James Bond",
                            'BookingID' => 12345,
                            'CheckInDate' => "2024-05-01",
                            'CheckOutDate' => "2024-05-05",
                            'Adults' => 2,
                            'Children' => 1,
                            'TotalPayment' => "800&euro;"
                        ],

                        '2' => [
                            'GuestName' => "James Bond",
                            'BookingID' => 54321,
                            'CheckInDate' => "2024-04-25",
                            'CheckOutDate' => "2024-04-30",
                            'Adults' => 1,
                            'Children' => 0,
                            'TotalPayment' => "600&euro;"
                        ],

                        '3' => [
                            'GuestName' => "James Bond",
                            'BookingID' => 98765,
                            'CheckInDate' => "2024-05-10",
                            'CheckOutDate' => "2024-05-15",
                            'Adults' => 3,
                            'Children' => 2,
                            'TotalPayment' => "1200&euro;"
                        ]
                    ];
                    
                    if (isset($_GET['sort'])) {
                        $sortOrder1 = $_GET['sort'];
                        if ($sortOrder1 === 'asc_payment') {
                            uasort($upcomingReservations, 'sortTotalPayment');
                        } elseif ($sortOrder1 === 'desc_payment') {
                            uasort($upcomingReservations, 'sortTotalPayment');
                            $upcomingReservations = array_reverse($upcomingReservations);
                        }
                    }
                    foreach ($upcomingReservations as $reservation) {
                        echo "<hr>";
                        echo "<strong>Guest name:</strong> " . $reservation['GuestName'] . "<br>";
                        echo "<strong>Booking ID:</strong> " . $reservation['BookingID'] . "<br>";
                        echo "<strong>CheckInDate:</strong> " . $reservation['CheckInDate'] . "<br>";
                        echo "<strong>CheckOutDate:</strong> " . $reservation['CheckOutDate'] . "<br>";
                        echo "<strong>Adults:</strong> " . $reservation['Adults'] . "<br>";
                        echo "<strong>Children:</strong> " . $reservation['Children'] . "<br>";
                        echo "<strong>TotalPayment:</strong> " . $reservation['TotalPayment'] . "<br>";
                        echo "<hr>";
                    }
                ?>
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