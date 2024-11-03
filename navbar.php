
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt">
    <!-- รายละเอียดอื่น ๆ ใน <head> -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var loginBtn = document.getElementById('loginBtn');

            loginBtn.addEventListener('click', function () {
                // เพิ่มหรือลบคลาส "clicked" เพื่อเปลี่ยนสี
                loginBtn.classList.toggle('clicked');
            });
        });
    </script>
    <style>
        html, body {
            font-family: 'Prompt', sans-serif !important;
        }
    </style>

</head>
<!-- navbar.php -->
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
        <div>
            <?php
            // ตรวจสอบสถานะการล็อกอิน
            if (isset($_SESSION['username'])) {
                // ถ้า login สำเร็จ แสดงปุ่ม Logout และ Profile
                echo '<a href="logout.php" class="btn">Logout</a>';
                echo '<a href="profile.php" class="btn">Profile</a>';
            } else {
                // ถ้ายังไม่ login ซึ่งคือสถานะ default แสดงปุ่ม Login และ Sign Up
                echo '<a href="register_and_login.php" class="login-btn">Login</a>';
                echo '<a href="register_and_login.php" class="btn">Sign Up</a>';
            }
            ?>
        </div>
    </nav>
</div>
