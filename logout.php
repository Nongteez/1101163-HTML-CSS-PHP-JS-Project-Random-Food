<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kin Rai Dee</title>
    <link rel="stylesheet" href="logout.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt">
    <link rel="icon" type="image/x-icon" href="PIC\LogoWeb.png">
    <!-- Include CSS and other head details -->
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="logout-container">
    <?php
    // ตรวจสอบว่ามี session ที่กำลังเปิดอยู่หรือไม่
    if (isset($_SESSION['username'])) {
        // ทำลาย session ทั้งหมด
        session_unset();
        session_destroy();
        
        echo "<script> alert ('You have been logged out successfully.'); 
        document.location.href = 'index.php';
    </script>";
    exit();
    } else {
        echo "<script> alert ('You are not currently logged in. 
        document.location.href = 'index.php';
    </script>";
        exit();
    }
    ?>
</div>

<!-- Include footer and other scripts -->

</body>
</html>
