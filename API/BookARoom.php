<?php
    // Output validation errors
//Koment
// Include the database connection file
include 'db_connection.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST['Full-Name'];
    $checkIn = $_POST['Check-In'];
    $checkOut = $_POST['Check-Out'];
    $adults = $_POST['Adults'];
    $children = $_POST['Children'];
    $room = $_POST['RoomId'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';


    // Perform server-side validation
    $errors = array();

    // Validate Full Name
    if (empty($fullName)) {
        $errors[] = "Full Name is required";
    }

    // Validate Check-In Date
    if (empty($checkIn)) {
        $errors[] = "Check-In Date is required";
    } elseif ($checkIn < date('Y-m-d')) {
        $errors[] = "Check-In Date must be at least today";
    }

    // Validate Check-Out Date
    if (empty($checkOut)) {
        $errors[] = "Check-Out Date is required";
    } elseif ($checkOut <= $checkIn) {
        $errors[] = "Check-Out Date must be after Check-In Date";
    }

    // Validate Adults and Children
    if ($adults == 0 && $children > 0) {
        $errors[] = "Cannot have Children without Adults";
    }

    // Output validation errors or proceed with further actions
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    } else {
        // Form is valid, proceed with inserting data into the database
// Prepare the SQL statement with placeholders
$sql = "INSERT INTO Bookings (RoomID, UserID, GuestName, CheckInDate, CheckOutDate, Adults, Children) VALUES (?, ?, ?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind parameters to the statement
$stmt->bind_param("iisssii", $room, $user_id, $fullName, $checkIn, $checkOut, $adults, $children);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement
$stmt->close();
    }
}

// Close database connection
$conn->close();
?>
