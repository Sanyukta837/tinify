<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="design">
            <div class="pill-1 rotate-45"></div>
            <div class="pill-2 rotate-45"></div>
            <div class="pill-3 rotate-45"></div>
            <div class="pill-4 rotate-45"></div>
        </div>
        <div class="login">
            <h3 class="title">User Login</h3>
            <form action="login.php" method="POST">
                <div class="text-input">
                    <i class="ri-admin-fill"></i>
                    <input type="text" placeholder="E-mail" name="email">
                </div>
                <div class="text-input">
                    <i class="ri-lock-fill"></i>
                    <input type="password" placeholder="Password" name="password">
                </div>
                <input type="submit" class="login-btn" value="Login">
            </form>
            <a href="forgotpass.php" class="forgot">Forgot Password?</a>
            <a href="user.php" class="forgot">Continue as Guest</a>
            <div class="create">
                <a href="registerform.php">Create Your Account</a>
                <i class="ri-arrow-right-fill"></i>
            </div>
        </div>
    </div>
</body>

</html>