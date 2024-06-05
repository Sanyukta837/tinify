<?php
  require 'database.php';

$database = new Database();
$connection = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password !== $confirmPassword) {
        echo "Password and confirm password do not match.";
        exit;
    }

    // Find the user associated with the token
    $query = "SELECT * FROM login WHERE reset_token = '" .$token."'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userId = $row['lid'];

        // Update the user's password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE login SET password = '$hashedPassword', reset_token = NULL WHERE lid = $userId";
        $result = mysqli_query($connection, $query);

        if ($result) {
        
            echo '<script>alert("Password reset successfully. You can now log in with your new password.");</script>';
            echo '<script>window.location.href = "http://localhost/project/final/loginpage.php";</script>';
            exit();
        } else {
            
            echo '<script>alert("Failed to reset password.");</script>';
            echo '<script>window.location.href = "http://localhost/project/final/user.php";</script>';
            exit();
        }
    } else {
        
        echo '<script>alert("Invalid or expired token.");</script>';
            echo '<script>window.location.href = "http://localhost/project/final/user.php";</script>';
            exit();
    }
}

