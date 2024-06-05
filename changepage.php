<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
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
            <h3 class="title">Change Password</h3>
            <form action="change-password.php" method="POST">
            <div class="text-input">
                    <i class="ri-user-fill"></i>
                    <input type="email" name="email" placeholder="E-mail" required>
                </div>
                <div class="text-input">
                    <i class="ri-user-fill"></i>
                    <input type="password" name="old_password" placeholder="Old password" required>
                </div>
                <div class="text-input">
                    <i class="ri-user-fill"></i>
                    <input type="password" name="password" placeholder="New password" required>
                </div>
                <div class="text-input">
                    <i class="ri-lock-fill"></i>
                    <input type="password" name="confirm_password" placeholder="Confirm new password" required>
                </div>
                <button type="submit" class="login-btn">Change</button>
            </form>

        </div>
</body>
</html>



