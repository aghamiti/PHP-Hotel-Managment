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