<?php
// Include the database connection file
include 'db_connection.php';


// Fetch room data from the database
$sql = "SELECT DISTINCT RoomID, RoomType, Price FROM rooms wHERE RoomType In(SELECT DISTINCT RoomType from rooms";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rooms = array();
    while ($row = $result->fetch_assoc()) {
        $room = array(
            "RoomID" => []
            //"RoomNumber" => $row["RoomNumber"],
            "RoomType" => $row["RoomType"],
            //"Description" => $row["Description"],
            "Price" => $row["Price"]
        );
        $rooms[] = $room;
    }
    // Return room data as JSON
    echo json_encode($rooms);
} else {
    echo json_encode(array()); // Return an empty array if no rooms found
}

// Close database connection
$conn->close();
?>
