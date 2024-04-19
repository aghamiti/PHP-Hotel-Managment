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
                    <h2 id="selectedMonth">April 2024</h2>
                    <select id="roomSelection" onchange="updateCalendar()">
                        <option value="room1">Room 1</option>
                        <option value="room2">Room 2</option>
                        <!-- Add more rooms as needed -->
                    </select>
                    <select id="monthSelection" onchange="updateCalendar()">
                        <option value="2024-04">April 2024</option>
                        <option value="2024-05">May 2024</option>
                        <!-- Add more months as needed -->
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

<button id="backToTopBtn" title="Go to top" onclick="topFunciton()"><img width="30px" height="30px"
                                                                         style="display: flex; align-items: center; justify-content: center;"
                                                                         src="../assets/images/backToTop.png" /></button>
<audio id="backToTopSound" src="../assets/audio/whoosh.mp3" type="audio/mp3"></audio>
<script src="../js/ClientSide/About-Us.js"></script>
<script src="../assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
<script>
    function updateCalendar() {
        var selectedRoom = document.getElementById("roomSelection").value;
        var selectedMonth = document.getElementById("monthSelection").value;
        document.getElementById("selectedMonth").innerText = selectedMonth;
        // Here you should fetch and populate the calendar based on selectedRoom and selectedMonth
        // You can use AJAX to fetch data from the server and update the calendar dynamically
        // For now, let's assume you have a function called populateCalendar(room, month) to update the calendar
        populateCalendar(selectedRoom, selectedMonth);
    }

    function populateCalendar(room, month) {
        // Here you can populate the calendar dynamically based on the selected room and month
        // For demonstration purposes, let's assume you have a JSON object containing booking information
        var bookings = {
            "room1": {
                "2024-04-01": "booked",
                "2024-04-02": "available",
                // Add more bookings as needed
            },
            "room2": {
                "2024-04-01": "available",
                "2024-04-02": "booked",
                // Add more bookings as needed
            }
            // Add more rooms as needed
        };

        var calendarBody = document.getElementById("calendarBody");
        calendarBody.innerHTML = ""; // Clear previous calendar content

        // Iterate over each day in the month
        var daysInMonth = new Date(month.substr(0, 4), month.substr(5, 2), 0).getDate();
        for (var i = 1; i <= daysInMonth; i++) {
            var dayDiv = document.createElement("div");
            dayDiv.className = "col day text-center";

            var dayHeader = document.createElement("h4");
            dayHeader.innerText = i;

            var bookingDiv = document.createElement("div");
            bookingDiv.className = bookings[room][month + "-" + (i < 10 ? "0" + i : i)]; // Get booking status for the day

            dayDiv.appendChild(dayHeader);
            dayDiv.appendChild(bookingDiv);
            calendarBody.appendChild(dayDiv);
        }
    }

    // Initial population of the calendar
    updateCalendar();
</script>
</body>
</html>
