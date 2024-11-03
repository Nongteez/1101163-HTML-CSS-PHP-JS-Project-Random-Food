<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="Signupstyles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt">
</head>

<body>
    <div class="navbar">
        <nav>
            <a href="index.php">
                <img src="\KINRAIDEE VS\PIC\logo1.png" class="logo">
            </a>
            <ul>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>

            <div class="signup-login">
                <div>
                    <a href="#" class="login-btn">Login</a>
                    <a href="#" class="btn">Sign Up</a>
                </div>
            </div>
        </nav>
    </div>

    <div class="main-regis">
        <div class="hide">
            <p>sadsad</p>
        </div>

        <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">
            <div class="signup">
                <!-- Your signup form here -->
            </div>

            <div class="login">
                <!-- Your login form here -->
                
                <div class="forgot-password">
                    <!-- Content for forgot password section -->
                    <h2>Forgot Password</h2>
                    <p>Enter your email address below to reset your password.</p>
                    <!-- Your form for password reset -->
                    <form action="password_reset_script.php" method="post">
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <button type="submit" name="reset_password">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
