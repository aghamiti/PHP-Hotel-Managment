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
        <li><a href="./rooms.html">Rooms</a></li>
    </ul>
    <a href="../ClientSide/login-signup.php">
        <img src="../assets/images/login-icon.png" alt="login-icon">
    </a>
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

