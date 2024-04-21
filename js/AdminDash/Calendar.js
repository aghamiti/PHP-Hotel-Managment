// Function to update the calendar based on selected room and month
function updateCalendar() {
    const selectedRoom = document.getElementById("roomSelection").value;
    const selectedMonth = document.getElementById("monthSelection").value;

    // Update the header with the selected month in 'F Y' format
    document.getElementById("selectedMonth").innerText = getMonthName(selectedMonth);

    // Fetch and update the calendar with the selected room and month
    fetchCalendarData(selectedRoom, selectedMonth);
}

// Function to fetch calendar data from the server
function fetchCalendarData(room, month) {
    fetch(`../API/getCalendarData.php?room=${room}&month=${month}`)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Error fetching calendar data: ${response.statusText}`);
            }
            return response.json(); // Assuming server returns JSON data
        })
        .then((data) => {
            populateCalendar(room, month, data); // Populate the calendar with fetched data
        })
        .catch((error) => {
            console.error(error);
            document.getElementById("calendarBody").innerText = "Error loading calendar data";
        });
}

// Function to populate the calendar with the fetched data
function populateCalendar(room, month, bookings) {
    const calendarBody = document.getElementById("calendarBody");
    calendarBody.innerHTML = ""; // Clear existing content

    const daysInMonth = getDaysInMonth(month);

    // Create a table to hold the days
    const table = document.createElement("table");
    table.className = "calendar-table";

    let row = document.createElement("tr");
    for (let i = 0; i < 7; i++) {
        const dayHeader = document.createElement("th");
        dayHeader.innerText = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"][i];
        row.appendChild(dayHeader);
    }
    table.appendChild(row);

    row = document.createElement("tr");
    const firstDayIndex = getFirstDayIndex(month); // Index of the first day of the month

    // Add empty cells before the first day
    for (let i = 0; i < firstDayIndex; i++) {
        const emptyCell = document.createElement("td");
        row.appendChild(emptyCell);
    }

    // Populate the calendar with days
    for (let day = 1; day <= daysInMonth; day++) {
        if (firstDayIndex + day - 1 % 7 === 0 && day !== 1) {
            table.appendChild(row);
            row = document.createElement("tr");
        }

        const dayCell = document.createElement("td");
        const dayDiv = document.createElement("div");
        dayDiv.className = "day-content";

        const dayHeader = document.createElement("h4");
        dayHeader.innerText = day;

        const fullDate = `${month}-${day.toString().padStart(2, "0")}`;

        const bookingStatus = bookings[room] ? bookings[room][fullDate] : "No data";
        const bookingDiv = document.createElement("div");
        bookingDiv.className = `booking-status ${bookingStatus}`;

        dayDiv.appendChild(dayHeader);
        dayDiv.appendChild(bookingDiv);
        dayCell.appendChild(dayDiv);
        row.appendChild(dayCell);
    }

    // Add any remaining empty cells to complete the last row
    while (row.childNodes.length < 7) {
        const emptyCell = document.createElement("td");
        row.appendChild(emptyCell);
    }

    table.appendChild(row);
    calendarBody.appendChild(table); // Append the final table to the calendar body
}

// Helper function to get the month name in 'F Y' format
function getMonthName(month) {
    const year = parseInt(month.substr(0, 4));
    const monthIndex = parseInt(month.substr(5, 2));
    const date = new Date(year, monthIndex - 1); // Adjust for zero-based month index
    return date.toLocaleString("default", { month: "long", year: "numeric" });
}

// Helper function to get the number of days in a given month
function getDaysInMonth(month) {
    const year = parseInt(month.substr(0, 4));
    const monthIndex = parseInt(month.substr(5, 2));
    return new Date(year, monthIndex, 0).getDate();
}

// Helper function to get the index of the first day of the given month
function getFirstDayIndex(month) {
    const year = parseInt(month.substr(0, 4));
    const monthIndex = parseInt(month.substr(5, 2));
    return new Date(year, monthIndex - 1, 1).getDay();
}

// Event listeners for room and month selection changes
document.getElementById("roomSelection").addEventListener("change", updateCalendar);
document.getElementById("monthSelection").addEventListener("change", updateCalendar);

// Initial calendar update
updateCalendar();
