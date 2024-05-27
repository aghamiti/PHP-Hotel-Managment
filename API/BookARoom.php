<?php
    // Output validation errors

// Include the database connection file
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST['Full-Name'];
    $checkIn = $_POST['Check-In'];
    $checkOut = $_POST['Check-Out'];
    $adults = $_POST['Adults'];
    $children = $_POST['Children'];

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
        $sql = "INSERT INTO Bookings (RoomID, GuestName, CheckInDate, CheckOutDate, Adults, Children)
                VALUES (1, '$fullName', '$checkIn', '$checkOut', $adults, $children)";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close database connection
$conn->close();
?>
