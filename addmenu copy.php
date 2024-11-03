<?php
session_start();
require 'addmenu_db.php';

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli('localhost', 'root', '', 'kinraidee');

if ($conn->connect_error) {
    die('การเชื่อมต่อล้มเหลว: ' . $conn->connect_error);
}

// ตรวจสอบ session
if (isset($_SESSION['username'])) {
    $role = '';

    // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
    $username = $_SESSION['username'];
    $sql = "SELECT role FROM account WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);

        if ($userData) {
            $role = $userData['role'];
        } else {
            echo "<script> alert ('ไม่พบข้อมูลผู้ใช้'); 
            document.location.href = 'index.php';
        </script>";
            exit();
        }
    } else {
   
        echo "<script> alert ('ไม่สามารถดึงข้อมูลผู้ใช้ได้'); 
        document.location.href = 'index.php';
    </script>";
        exit();
    }

    // ตรวจสอบสิทธิ์
    if ($role === 'a' || $role === 's') {
        // สิทธิ์ของ Admin (a) หรือ Store (s)
        // ตั้งค่าสิ่งที่คุณต้องการทำในหน้า addmenu.php ที่นี้
    } else {
        
        echo "<script> alert ('คุณไม่มีสิทธิ์ในการเข้าถึงหน้านี้'); 
        document.location.href = 'index.php';
    </script>";
        exit();
    }
} else {
   
    echo "<script> alert ('กรุณา login เพื่อเข้าถึงหน้านี้'); 
        document.location.href = 'index.php';
    </script>";
    exit();
    
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kin Rai Dee</title>
    <link rel="stylesheet" href="Addmenu.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt">
    <link rel="icon" type="image/x-icon" href="/PIC/LogoWeb.png">
</head>
<body>
<?php include 'navbar.php'; ?>
    

    <div class="form">
        <div class="title">Welcome</div>
        <div class="subtitle">Add Food Menu!</div>

        <form action="addmenu_db.php" method="post" enctype="multipart/form-data">
        
        <div class="input-container ic2">
            <input id="foodtype" class="input" type="text" placeholder=" " name="foodtype" />
            <div class="cut"></div>
            <label for="foodtype" class="placeholder">Food Type</label>
        </div>

        <div class="input-container ic2">
            <input id="shopname" class="input" type="text" placeholder=" " name="shopname" />
            <div class="cut"></div>
            <label for="shopname" class="placeholder">Shop Name</label>
        </div>

        <div class="input-container ic2">
            <input id="address" class="input" type="text" placeholder=" " name="address"/>
            <div class="cut cut-short"></div>
            <label for="address" class="placeholder">Address</label>
        </div>

        <div class="input-container ic2">
            <input id="linkmaps" class="input" type="text" placeholder=" " name="linkmaps"/>
            <div class="cut"></div>
            <label for="linkmaps" class="placeholder">Link Google Maps</label>
        </div>

        <div class="input-container ic2">
            <input id="image" class="input" type="file" placeholder=" " name="image" accept=".jpg, .jpeg, .png, .gif" value=""/>
            <div class="cut"></div>
            <label for="image" class="placeholder">Upload food Picture</label>
        </div>

        <!-- ปุ่ม submit ต้องอยู่ภายใน div form -->
        <button type="submit" class="submit" name="submit">Submit</button>

        </form>
    </
