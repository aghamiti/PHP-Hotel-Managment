<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
    <?php if(isset($_SESSION['login_user'])): ?>
        <h7>Welcome, <?php echo htmlspecialchars($_SESSION['login_user']); ?></h7>
        <h7><a href="../API/logout.php">Logout</a></h7>
    <?php else: ?>
        <h7><a href="../ClientSide/login-signup.php">Login / Signup</a></h7>
    <?php endif; ?>
</nav>

<header class="header">
    <h1>Calendar</h1>
</header>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="calendar">
                <div class="calendar-header">
                    <h2 id="selectedMonth">April 2024</h2>
                    <select id="roomSelection" onchange="updateCalendar()">
                        <option value="room1">Room 1</option>
                        <option value="room2">Room 2</option>
                        <!-- Add more rooms as needed -->
                    </select>
                    <select id="monthSelection" onchange="updateCalendar()">
                        <?php
                        // Generate options for the next 12 months
                        for ($i = 0; $i < 12; $i++) {
                            $nextMonth = date('Y-m', strtotime("+" . $i . " months"));
                            $monthName = date('F Y', strtotime($nextMonth));
                            echo "<option value=\"$nextMonth\">$monthName</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="calendar-body" id="calendarBody">
                    <!-- Calendar days will be populated here -->
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <!-- Footer content -->
</footer>

<button id="backToTopBtn" title="Go to top" onclick="topFunciton()">
    <img
            width="30px" height="30px"
            style="display: flex; align-items: center; justify-content: center;"
            src="../assets/images/backToTop.png" />
</button>
<audio id="backToTopSound" src="../assets/audio/whoosh.mp3" type="audio/mp3"></audio>
<script src="../js/AdminDash/Calendar.js"></script>
<script src="../assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
