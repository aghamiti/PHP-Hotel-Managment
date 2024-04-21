<?php
// Function to convert relative time to absolute DateTime
$feedback = ''; // Initialize feedback variable
function convertRelativeTime($relativeTime) {
    $now = new DateTime();
    $number = (int) filter_var($relativeTime, FILTER_SANITIZE_NUMBER_INT);

    switch (true) {
        case strpos($relativeTime, 'day') !== false:
            return $now->sub(new DateInterval("P{$number}D"));
        case strpos($relativeTime, 'week') !== false:
            return $now->sub(new DateInterval("P{$number}W"));
        case strpos($relativeTime, 'month') !== false:
            return $now->sub(new DateInterval("P{$number}M"));
        case strpos($relativeTime, 'year') !== false:
            return $now->sub(new DateInterval("P{$number}Y"));
        default:
            return $now; // Default to current time if no clear match
    }
}

// Custom function for sorting messages from newest to oldest
function compareMessages($a, $b) {
    $timeA = convertRelativeTime($a['time']);
    $timeB = convertRelativeTime($b['time']);

    if ($timeA < $timeB) {
        return 1;
    } elseif ($timeA > $timeB) {
        return -1;
    } else {
        return 0;
    }
}

// Initialization of static message data
$messages = [
    [
        'name' => 'John Doe',
        'content' => 'Thank you for the excellent service during my stay!',
        'time' => '2 days ago',
        'status' => 'Seen',
        'replies' => []
    ],
    [
        'name' => 'Jane Smith',
        'content' => 'Can you confirm my reservation for next month?',
        'time' => '1 week ago',
        'status' => 'Unseen',
        'replies' => []
    ],
    [
        'name' => 'Mark Lee',
        'content' => 'There was an issue with the air conditioning in my room. Can you assist?',
        'time' => '1 month ago',
        'status' => 'Seen',
        'replies' => []
    ]
];

// Sort the messages from newest to oldest
usort($messages, 'compareMessages');

// Handle form submission for replying to messages
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guestName = isset($_POST['guestName']) ? $_POST['guestName'] : '';
    $replyContent = isset($_POST['reply']) ? $_POST['reply'] : '';

    $replyAdded = false;

    // Check if there's an existing message with the same guest name
    foreach ($messages as &$message) {  // Use reference to maintain changes
        if ($message['name'] === $guestName) {
            // If the guest name exists, add the reply
            $message['replies'][] = [
                'content' => $replyContent,
                'time' => 'Just now',
                'status' => 'Sent'
            ];
            $replyAdded = true; // Indicate that the reply was successfully added
            break; // No need to check other messages
        }
    }

    // If no reply was added, provide feedback to the user
    if (!$replyAdded) {
        $feedback = 'No matching guest found. Please check the name and try again.';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spring Hotel | Messages | Admin</title>
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/AdminDash/Messages.css">
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
    <h1>Messages</h1>
</header>

<!-- Compose Reply Form -->
<div class="container mt-5">
    <h1>Messages Inbox</h1>
    <div id="messages" class="list-group">
        <?php foreach ($messages as $message): ?>
            <div class="list-group-item">
                <h5 class="mb-1"><?php echo $message['name']; ?></h5>
                <small><?php echo $message['time']; ?></small>
                <p><?php echo $message['content']; ?></p>
                <small>Status: <?php echo $message['status']; ?></small>

                <!-- Display nested replies if any -->
                <?php if (!empty($message['replies'])): ?>
                    <div class="ml-3">
                        <?php foreach ($message['replies'] as $reply): ?>
                            <div class="list-group-item">
                                <p class="mb-1"><?php echo $reply['content']; ?></p>
                                <small><?php echo $reply['time']; ?></small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Display feedback message if no reply was added -->
    <?php if ($feedback): ?>
        <div class="alert alert-warning mt-4"><?php echo $feedback; ?></div>
    <?php endif; ?>

    <!-- Form to compose a reply -->
    <div id="compose" class="mt-4">
        <h3>Compose Reply</h3>
        <form method="POST" action="">
            <div class="form-group">
                <label for="guestName">Guest Name:</label>
                <input type="text" class="form-control" id="guestName" name="guestName" required>
            </div>
            <div class="form-group">
                <label for="reply">Reply Message:</label>
                <textarea class="form-control" id="reply" name="reply" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
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
            <p><span><a href="https://www.google.com/maps/search/6036+Richmond Hwy,+Alexandria,+VA+2230/@38.7860603,-77.0740174,16.25z?entry=ttu"
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
    <div class cls="footer-socials">
        <a href="https://www.instagram.com/" target="_blank"><img src="../assets/images/instagram.png"
                                                                  class="footer-socials-icon"></a>
        <a href="https://www.facebook.com/" target="_blank"><img src="../assets/images/facebook.png"
                                                                 class="footer-socials-icon"></a>
        <a href="https://twitter.com/" target="_blank"><img src="../assets/images/twitter.png"
                                                            class="footer-socials-icon"></a>
    </div>
</footer>

<button id="backToTopBtn" title="Go to top" onclick="topFunction()">
    <img
            width="30px" height="30px"
            src="../assets/images/backToTop.png" alt="Back to Top Button"
    />
</button>
<audio id="backToTopSound" src="../assets/audio/whoosh.mp3" type="audio/mp3"></audio>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
