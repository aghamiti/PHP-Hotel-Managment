<?php
header('Content-Type: application/json');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../API/db_connection.php';

$query = "SELECT b.BookingID, b.GuestName, r.RoomType, b.CheckInDate, b.CheckOutDate 
          FROM Bookings b
          JOIN Rooms r ON b.RoomID = r.RoomID
          WHERE b.CheckInDate >= CURDATE()";

$result = $conn->query($query);

$reservations = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservations[] = [
            'id' => $row['BookingID'],
            'guestName' => $row['GuestName'],
            'roomType' => $row['RoomType'],
            'checkInDate' => $row['CheckInDate'],
            'checkOutDate' => $row['CheckOutDate']
        ];
    }
}

echo json_encode($reservations);
?>
