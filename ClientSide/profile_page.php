<?php
    session_start();
        $user_id = $_SESSION['user_id'];
        $dbserver = "";
        $dbuser = "";
        $dbpassword = "";
        $dbname = "";
        $conn = mysqli_connect($dbserver, $dbuser, $dbpassword, $dbname);
        if (!$conn) {
            echo 'Connection error: ' . mysqli_connect_error();
        }
        $user_id = mysqli_real_escape_string($conn, $user_id);
        $sql = "SELECT * FROM Bookings";
        $sql1 = "SELECT Price FROM Rooms";
        $result = mysqli_query($conn, $sql); //Rezultati i Bookings
        $result1 = mysqli_query($conn, $sql1); //Prices ne Rooms
        $bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $prices = mysqli_fetch_all($result1, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_free_result($result1);
        mysqli_close($conn);  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/ClientSide/Home.css ">
    <link rel="stylesheet" href="Home.css">
    <script src="https://kit.fontawesome.com/a710a530b9.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../assets/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script defer src="../assets/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

    <title>Spring Hotel &amp; Spa</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="logoja">
        <a href="index.php"><img src="../assets/images/Logo.png" alt="Logo" /></a>
    </div>
    
    <nav class="navbar">
        <div></div>
        <ul>
        <li><a href="./index.php">Home</a></li>
            <li><a href="./About-Us.html">About Us</a></li>
            <li><a href="./Contacts.html">Contacts</a></li>
            <li><a href="./FAQ.html">FAQ</a></li>
            <li><a href="./Events.php">Events</a></li>
        </ul>

        <a id="loginLink" href="profile_page.php">
        <i class="fa-solid fa-user"></i>
        </a>
        <h7 id="welcomeMessage" style="display: none;">Welcome <?php echo $username; ?></h7>
        <script>
       
            document.addEventListener("DOMContentLoaded", function() {
        
                const loginIcon = document.getElementById("loginIcon");
                const welcomeMessage = document.getElementById("welcomeMessage");

      
                function toggleElements() {
                loginIcon.style.display = (loginIcon.style.display === "none") ? "block" : "none";
                welcomeMessage.style.display = (welcomeMessage.style.display === "none") ? "block" : "none";
                }
                toggleElements(); 

        
                setTimeout(function() {
                setTimeout(toggleElements, 2000);
                }, 2000); 
            });
        </script>
    </nav>
</body>