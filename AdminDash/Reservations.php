<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <title>Incoming Reservations - Hotel Admin</title>
    <link rel="stylesheet" href="../css/AdminDash/Reservations.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/bootstrap-5.0.2-dist/css/bootstrap-grid.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <?php if(isset($_SESSION['login_user'])): ?>
        <h7>Welcome, <?php echo htmlspecialchars($_SESSION['login_user']); ?></h7>
        <h7><a href="../API/logout.php">Logout</a></h7>
    <?php else: ?>
        <h7><a href="../ClientSide/login-signup.php">Login / Signup</a></h7>
    <?php endif; ?>
</nav>

<header class="header">
    <h1>Reservations</h1>
</header>
<div class="container mt-5">
    <h1>Incoming Reservations - Hotel Admin</h1>

    <!-- Reservation List -->
    <div class="mt-4">
        <h3>Reservation List:</h3>
        <div class="list-group" id="reservationList">
            <!-- Reservations will be dynamically added here -->
        </div>
    </div>

    <!-- Reservation Details Modal -->
    <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservationModalLabel">Reservation Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Reservation details will be displayed here -->
                    <div id="reservationDetails"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="row footer-main">
        <div class="col-md-4 footer-main-opening">
            <h2>Opening Hours</h2>
            <p><span class="footer-weekendweekdays">Weekdays:</span> 8:00 AM - 8:00 PM</p>
            <p><span class="footer-weekendweekdays">Weekends:</span> 9:00 AM - 6:00 PM</p>
        </div>
        <div class="col-md-4 footer-main-adress">
            <h2>Address</h2>
            <p><span><a href="https://www.google.com/maps/search/6036+Richmond+Hwy,+Alexandria,+VA+2230/@38.7860603,-77.0740174,16.25z?entry=ttu"
                        target="_blank">
                        <address style="margin: 0;"><img src="../assets/images/location.png"
                                                         class="footer-location-icon"/>6036 Richmond Hwy, Alexandria, VA 2230</address>
                    </a></span></p>

            <p><img src="../assets/images/call.png" class="footer-call-icon">Call Us: <a href="tel:+1 (409) 987–5874">+1
                    (409) 987–5874</a></p>
            <a href="mailto:spring@hotel.com"><img src="../assets/images/email.png"
                                                   class="footer-call-icon">spring@hotel.com</a>
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

<button id="backToTopBtn" title="Go to top" onclick="topFunciton()">
    <img
            width="30px" height="30px"
            style="display: flex; align-items: center; justify-content: center;"
            src="../assets/images/backToTop.png" />
</button>
<audio id="backToTopSound" src="../assets/audio/whoosh.mp3" type="audio/mp3"></audio>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom JavaScript -->
<script>
    // Sample reservations data (replace with your actual data)
    var reservations = [
        { id: 1, guestName: 'John Doe', roomType: 'Standard', checkInDate: '2024-04-20', checkOutDate: '2024-04-25' },
        { id: 2, guestName: 'Jane Smith', roomType: 'Deluxe', checkInDate: '2024-04-22', checkOutDate: '2024-04-24' }
    ];

    // Function to display reservation details in modal
    function showReservationDetails(id) {
        var reservation = reservations.find(reservation => reservation.id === id);
        var modalContent = `
        <p><strong>Guest Name:</strong> ${reservation.guestName}</p>
        <p><strong>Room Type:</strong> ${reservation.roomType}</p>
        <p><strong>Check-in Date:</strong> ${reservation.checkInDate}</p>
        <p><strong>Check-out Date:</strong> ${reservation.checkOutDate}</p>
      `;
        $('#reservationDetails').html(modalContent);
        $('#reservationModal').modal('show');
    }

    // Function to dynamically generate reservation list
    function generateReservationList() {
        var listItems = '';
        reservations.forEach(reservation => {
            listItems += `
          <a href="#" class="list-group-item list-group-item-action" onclick="showReservationDetails(${reservation.id})">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">${reservation.guestName}</h5>
              <small>${reservation.checkInDate} - ${reservation.checkOutDate}</small>
            </div>
            <p class="mb-1">Room Type: ${reservation.roomType}</p>
          </a>
        `;
        });
        $('#reservationList').html(listItems);
    }

    // Call function to generate reservation list on page load
    $(document).ready(function() {
        generateReservationList();
    });
</script>
</body>
</html>

