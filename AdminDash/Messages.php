<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spring Hotel | Messages | Admin</title>
    <link rel="stylesheet" href="../css/AdminDash/Messages.css" >
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
    </ul>
    <a href="../ClientSide/login-signup.php">
        <img src="../assets/images/login-icon.png" alt="login-icon">
    </a>
</nav>

<header class="header">
    <h1>Messages</h1>
</header>
<div class="container mt-5">
    <h1>Guest Messages - Hotel Admin</h1>

    <!-- Inbox -->
    <div class="mt-4">
        <h3>Inbox:</h3>
        <div class="list-group" id="inbox">
            <!-- Messages will be dynamically added here -->
        </div>
    </div>

    <!-- Compose Message -->
    <div class="mt-4">
        <h3>Compose Message:</h3>
        <form id="composeForm">
            <div class="form-group">
                <label for="guestName">Guest Name:</label>
                <input type="text" class="form-control" id="guestName" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" id="message" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom JavaScript -->
<script>
    // Handle form submission
    $('#composeForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get form values
        var guestName = $('#guestName').val();
        var message = $('#message').val();

        // AJAX call to send message data to PHP script
        $.ajax({
            url: 'process_message.php',
            type: 'POST',
            data: {
                guestName: guestName,
                message: message
            },
            success: function(response) {
                // Clear form fields after successful submission
                $('#guestName').val('');
                $('#message').val('');

                // Optional: Display success message or perform other actions
                console.log('Message sent successfully');
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error:', error);
            }
        });
    });
</script>
</body>
</html>
