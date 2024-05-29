<?php
header('Content-Type: application/json');

include 'db_connection.php'; // Include the database connection file

// Retrieve form data
$checkIn = $_POST['Check-In'];
$checkOut = $_POST['Check-Out'];
$adults = $_POST['Adults'];
$children = $_POST['Children'];

// Validate received data
if (empty($checkIn) || empty($checkOut) || empty($adults)) {
    echo json_encode(['error' => 'Invalid input data']);
    exit;
}

// Convert dates to proper format
$checkInDate = date('Y-m-d', strtotime($checkIn));
$checkOutDate = date('Y-m-d', strtotime($checkOut));

// Prepare SQL to find available rooms
$sql = "
    SELECT * FROM rooms WHERE RoomID NOT IN (
        SELECT RoomID FROM bookings WHERE (
            (CheckInDate <= ? AND CheckOutDate > ?) OR
            (CheckInDate < ? AND CheckOutDate >= ?)
        )
    )
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ssss', $checkOutDate, $checkInDate, $checkOutDate, $checkInDate);
$stmt->execute();
$result = $stmt->get_result();

// Prepare rooms array
$availableRooms = [];
while ($row = $result->fetch_assoc()) {
    $availableRooms[] = [
        'roomId' => $row['RoomID'],
        'roomNumber' => $row['RoomNumber'],
        'roomType' => $row['RoomType'],
        'description' => $row['Description'],
        'price' => $row['Price'],
        'coverPhoto' => 'path_to_cover_photo' // You need to update this based on your implementation
    ];
}

// Return the available rooms as JSON
echo json_encode($availableRooms);

// Close database connection
$conn->close();
?>
