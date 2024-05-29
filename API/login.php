<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

require_once 'db_connection.php';  // Ensure the correct database connection file is included
session_start();

class User {
    protected $conn;
    protected $username;
    protected $password;
    protected $role;

    public function __construct(&$dbConnection) {  // Use reference for db connection
        $this->conn =& $dbConnection;  // Assign by reference
    }

    public function setUsername($username) {
        $this->username = mysqli_real_escape_string($this->conn, $username);
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function login() {
        $stmt = $this->conn->prepare("SELECT UserID, Password, UserRole FROM Users WHERE Username = ? OR Email = ?");
        $stmt->bind_param("ss", $this->username, $this->username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($this->password, $user['Password'])) {
            $_SESSION['login_user'] =& $this->username;  // Assign by reference
            $_SESSION['user_id'] =& $user['UserID'];  // Assign by reference
            $this->role = $user['UserRole'];
            $this->redirectBasedOnRole();
            return true;
        } else {
            $_SESSION['login_error'] = "Invalid Username or Password.";
            return false;
        }
    }

    protected function redirectBasedOnRole() {
        if ($this->role === 'admin') {
            header("location: ../AdminDash/calendar.php");
        } else {
            header("location: ../ClientSide/index.php");
        }
        exit;
    }
}

class AdminUser extends User {
    protected function redirectBasedOnRole() {
        header("location: ../ClientSide/admin_dashboard.php");
        exit;
    }
}

$user = new User($conn);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $user->setUsername($_POST['username']);
    $user->setPassword($_POST['password']);

    if ($user->login()) {
        // Redirection is handled within the login method based on user role
    } else {
        header("location: ../ClientSide/login.php"); // Redirect back to the login page
    }
}
?>
