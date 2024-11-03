<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kin Rai Dee</title>
    <link rel="stylesheet" href="Signupstyles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt">
    <link rel="icon" type="image/x-icon" href="PIC\LogoWeb.png">
    <style>
        html, body {
            font-family: 'Prompt', sans-serif !important;
        }
    </style>
</head>
<body>
<div>
        <!-- Your registration form and other content -->

        <?php
            // Check if registration success parameter is present in the URL
            if (isset($_GET['registration']) && $_GET['registration'] == 'success') {
                echo "<p>Registration Success...</p>";
            }
        ?>
    </div>

    <?php include 'navbar.php'; ?>

  <div class="main-regis">
       
    <div class="hide">
        <p>sadsad</p>
       </div>
       
      <div class="main">
       
        <input type="checkbox"id="chk" aria-hidden="true">

        <div class="signup">
                <form action="register_and_login_db.php" method="post">
                    <label for="chk" aria-hidden="true">Sign up</label>
                    <input type="email" name="email" placeholder="Email" required="" id="email">
                    <input type="text" name="username" placeholder="Username" required="" id="username">
                    <input type="password" name="password" placeholder="Password" required="" id="password">

                    <div class="wrapper">
                        <input type="radio" name="role" value="1" id="option-1" checked>
                        <input type="radio" name="role" value="2" id="option-2">
                        <label for="option-1" class="option option-1">
                            <div class="dot"></div>
                            <span>User</span>
                        </label>
                        <label for="option-2" class="option option-2">
                            <div class="dot"></div>
                            <span>Store</span>
                        </label>
                    </div>
                    <button name="register" type="submit">Sign Up</button>
                </form>
            </div>

            <!------------------------------>
            <div class="login">
                <form action="login_db.php" method="post">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="text" name="username" placeholder="Username or Email" required="">
                <input type="password" name="password" placeholder="Password" required="">
                        
                    <div class="forgot-password">
                            <a  href="forgot_password.php">Forgot Password?</a>
                        
                        </div>  
                    <button name="login" type="submit">Login</button>
                </form>
                
            </div>
        
        </div>
    </div>
     

    
    
    </body>
</html>    