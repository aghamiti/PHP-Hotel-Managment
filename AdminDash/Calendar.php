<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to generate the static calendar for a given month and year
function generateStaticCalendar($month, $year) {
    $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $firstDayOfWeek = date('w', strtotime("$year-$month-01"));

    echo '<table class="calendar-table">';
    echo '<tr>';
    echo '<th>Sun</th>';
    echo '<th>Mon</th>';
    echo '<th>Tue</th>';
    echo '<th>Wed</th>';
    echo '<th>Thu</th>';
    echo '<th>Fri</th>';
    echo '<th>Sat</th>';
    echo '</tr>';
    echo '<tr>';

    // Fill empty cells before the first day
    for ($i = 0; $i < $firstDayOfWeek; $i++) {
        echo '<td class="empty-cell"></td>';
    }

    // Output the days for the current month
    for ($day = 1; $day <= $numDays; $day++) {
        if (($firstDayOfWeek + $day - 1) % 7 == 0 && $day > 1) {
            echo '</tr><tr>'; // New row for each week
        }
        $dayOfWeek = date('D', strtotime("$year-$month-$day"));
        echo "<td class='day-cell' title='Day $day'>$day<br><small>$dayOfWeek</small></td>";
    }

    // Fill empty cells after the last day to complete the row
    $remainingCells = 7 - (($firstDayOfWeek + $numDays - 1) % 7) - 1;
    for ($i = 0; $remainingCells > 0; $i++, $remainingCells--) {
        echo '<td class="empty-cell"></td>';
    }

    echo '</tr>';
    echo '</table>';
}

// Determine the sorting order
$sortOrder = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'normal'; // 'normal' or 'reverse'

// Generate the list of month options
$monthOptions = [];
$startMonth = date('Y-m', strtotime("-6 months"));
$endMonth = date('Y-m', strtotime("+12 months"));

$monthIndex = 0;
for ($i = strtotime($startMonth); $i <= strtotime($endMonth); $i = strtotime('+1 month', $i), $monthIndex++) {
    $monthOptions[$monthIndex] = [
        'value' => date('Y-m', $i),
        'label' => date('F Y', $i),
    ];
}

// Sort the month options based on the selected order
if ($sortOrder === 'desc') {
    krsort($monthOptions); // Sort by keys in reverse order
} else {
    ksort($monthOptions); // Sort by keys in normal order
}

// Determine the selected month and year
$selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('Y-m');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spring Hotel | Calendar | Admin</title>
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
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
        <li><a href="./Messages.php">Inbox</li>
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

<div class="container mt-5 ">
    <h1 style="text-align: center; font-family: Poppins;">Calendar of Bookings</h1>

    <!-- Sorting radio buttons for sort order -->
    <form action="" method="get" class="mb-3 d-flex flex-column align-items-center" style="font-size: 20px; font-family: Poppins;">
        <label for="monthSelection" class="form-label">Select Month:</label>
        <select name="month" id="monthSelection" class="form-select form-select-sm" style="width: 250px; font-size: 20px; font-family: Poppins; text-align: center;" onchange="this.form.submit()">
            <?php
            foreach ($monthOptions as $index => $option) {
                $selected = ($option['value'] == $selectedMonth) ? 'selected' : '';
                echo "<option value='{$option['value']}' {$selected}>{$option['label']}</option>";
            }
            ?>
        </select>

        <div style="margin-top: 20px" class="mb-2">
            <label class="form-check-label">Sort Months:</label>
        </div>
        <div class="form-check form-check-inline" style="margin-right: 10px;">
            <input class="form-check-input" type="radio" name="sort_order" value="asc" id="sortAsc" onchange="this.form.submit()" <?php echo (isset($_GET['sort_order']) && $_GET['sort_order'] === 'asc') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="sortAsc">Oldest</label>
        </div>
        <div class="form-check form-check-inline" style="margin-right: 10px;">
            <input class="form-check-input" type="radio" name="sort_order" value="desc" id="sortDesc" onchange="this.form.submit()" <?php echo (isset($_GET['sort_order']) && $_GET['sort_order'] === 'desc') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="sortDesc">Newest</label>
        </div>
    </form>

    <!-- Generate the calendar for the selected month -->
    <?php
    list($year, $month) = explode('-', $selectedMonth);
    generateStaticCalendar($month, $year);
    ?>
</div>

<footer>
    <div class="footer-main">
        <div class="col-md-4 footer-main-opening">
            <h2>Opening Hours</h2>
            <p><span class="footer-weekendweekdays">Weekdays:</span> 8:00 AM - 8:00 PM</p>
            <p><span class="footer-weekendweekdays">Weekends:</span> 9:00 AM - 6:00 PM</p>
        </div>
        <div class="col-md-4 footer-main-adress">
            <h2>Address</h2>
            <p><span><a href="https://www.google.com/maps/search/6036+Richmond+Hwy,+Alexandria,+VA+2230/@38.7860603,-77.0740174,16.25z?entry=ttu"
                        target="_blank"><img src="../assets/images/location.png"
                                             class="footer-location-icon"/>6036 Richmond Hwy, Alexandria, VA 2230</a></span></p>
            <p><img src="../assets/images/call.png" class="footer-call-icon">Call Us: <a href="tel:+1 (409) 987–5874">+1 (409) 987–5874</a></p>
            <a href="mailto:spring@hotel.com"><img src="../assets/images/email.png" class="footer-call-icon">spring@hotel.com</a>
        </div>
    </div>
    <div class="footer-socials">
        <a href="https://www.instagram.com/" target="_blank"><img src="../assets/images/instagram.png" class="footer-socials-icon"></a>
        <a href="https://www.facebook.com/" target="_blank"><img src="../assets/images/facebook.png" class="footer-socials-icon"></a>
        <a href="https://twitter.com/" target="_blank"><img src="../assets/images/twitter.png" class="footer-socials-icon"></a>
    </div>
</footer>

<button id="backToTopBtn" title="Go to top" onclick="topFunciton()">
    <img src="../assets/images/backToTop.png" width="30px" height="30px"/>
</button>
<audio id="backToTopSound" src="../assets/audio/whoosh.mp3" type="audio/mpeg"></audio>

<!-- Scripts -->
<script>
    var backToTopButton = document.getElementById("backToTopBtn");
    var audio = document.getElementById("backToTopSound");

    window.onscroll = function () {
        var body = document.body;
        var html = document.documentElement;

        var height = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollTop, html.offsetHeight);

        if (window.pageYOffset > height / 4) {
            backToTopButton.style.display = "block";
        } else {
            backToTopButton.style.display = "none";
        }
    }

    function topFunciton() {
        window.scrollTo({top: 0, behavior: "smooth"});
        audio.play();
    }

</script>

</body>
</html>
