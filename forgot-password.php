<?php
require 'database.php';

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$database = new Database();
$connection = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if email exists in the database
    $query = "SELECT * FROM login WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32));

        // Store the token in the database for the user
        $query = "UPDATE login SET reset_token = '$token' WHERE email = '$email'";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo '<script>alert("Email does not exist!");</script>';
            echo '<script>window.location.href = "http://localhost/project/final/user.php";</script>';
            exit();
        }
        else{

            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'amansenpai01@gmail.com';
            $mail->Password = 'edicmxepwohktoxt';

            // Send password reset email to the user

            $resetLink = "http://localhost/project/final/resetpass.php?token=$token";
            $mail->setFrom('amansenpai01@gmail.com');
            $mail->addAddress($email);
            $mail->Subject = 'Link to reset password';
            $emailBody = "Click the following link to reset your password: $resetLink";
            $mail->Body = $emailBody;
            
            $mail->send();

            // Send the email
            if ($mail->send()) {
        
                echo '<script>alert("An email has been sent with instructions to reset your password.");</script>';
            echo '<script>window.location.href = "http://localhost/project/final/user.php";</script>';
            exit();
            } else {
                echo 'Error: ' . $mail->ErrorInfo;
            }
    }
        }else{
            
            echo '<script>alert("Email does not exist!");</script>';
            echo '<script>window.location.href = "http://localhost/project/final/user.php";</script>';
            exit();
        }

            
}

?>
