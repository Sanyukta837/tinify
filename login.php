<?php

require 'database.php';

$database = new Database();
$connection = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM login WHERE email = '" .$email."'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email_db = $row['email'];
        $password_db = $row['password'];


        if ( $email === $email_db && password_verify($password, $password_db)) {
            // Password is correct
            
            
            // Output JavaScript code to display an alert message after redirect
    echo '<script>alert("Welcome, you have successfully logged in!");</script>';
    echo '<script>window.location.href = "http://localhost/project/final/premiumuser.php";</script>';

    exit(); // Ensure no further PHP code is executed
        }
        elseif ($email == "" || $password == "" || $email == null || $password == null) {
            echo '<script>alert("Please Fill out the details!");</script>';
            echo '<script>window.location.href = "http://localhost/project/final/loginpage.php";</script>';
            exit();
        }
        elseif ($email == null && $password == null) {
            echo '<script>alert("Please Fill out the details!");</script>';
            echo '<script>window.location.href = "http://localhost/project/final/loginpage.php";</script>';
            exit();
        }
         else {
            // Password is incorrect
            echo '<script>alert("Invalid Login Credential");</script>';
            echo '<script>window.location.href = "http://localhost/project/final/loginpage.php";</script>';
            exit();
        }




}
}



?>

   