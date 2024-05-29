<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../API/db_connection.php';

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $roomNumber = $_POST['roomNumber'];
                $roomType = $_POST['roomType'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $image = $_FILES['roomImage']['name'];
                $target = "uploads/" . basename($image);

                if (move_uploaded_file($_FILES['roomImage']['tmp_name'], $target)) {
                    $sql = "INSERT INTO rooms (RoomNumber, RoomType, Description, Price, ImageURL) VALUES ('$roomNumber', '$roomType', '$description', '$price', '$target')";
                    if ($conn->query($sql) === TRUE) {
                        echo json_encode(["status" => "success", "message" => "Room added successfully"]);
                    } else {
                        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
                    }
                } else {
                    echo json_encode(["status" => "error", "message" => "Failed to upload image"]);
                }
                break;
            case 'delete':
                $roomId = $_POST['roomId'];
                $sql = "DELETE FROM rooms WHERE RoomID='$roomId'";
                if ($conn->query($sql) === TRUE) {
                    echo json_encode(["status" => "success", "message" => "Room deleted successfully"]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
                }
                break;
        }
    }
    exit;
}

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM rooms";
    $result = $conn->query($sql);
    $rooms = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rooms[] = $row;
        }
    }

    echo json_encode($rooms);
    exit;
}
?>
