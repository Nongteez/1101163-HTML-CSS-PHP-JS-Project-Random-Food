<?php
require 'connection.php';
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['username'])) {
    echo "<script>alert('User not logged in'); 
          document.location.href = 'register_and_login.php';</script>";
    exit();
}
// ตรวจสอบว่ามีการส่งข้อมูลมาหรือไม่
if (isset($_POST['new_username']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
    // นำข้อมูลมาใส่ตัวแปร
    $newUsername = mysqli_real_escape_string($conn, $_POST['new_username']);
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $username = $_SESSION['username'];

    // ตรวจสอบว่าไม่มีค่าว่าง
    if (empty($newUsername) || empty($newPassword) || empty($confirmPassword)) {
        echo "<script>alert('Please fill in all required fields.'); 
              document.location.href = 'profile.php';</script>";
        exit();
    }

    // เพิ่มตรวจสอบความถูกต้องของรหัสผ่าน
    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('Passwords do not match. Please try again.'); 
              document.location.href = 'profile.php';</script>";
        exit();
    }

    // ตรวจสอบการเชื่อมต่อฐานข้อมูล
    if ($conn) {
        // ตรวจสอบว่า Username ที่เลือกใหม่ไม่ซ้ำกับ Username ในระบบ
        $checkUsernameQuery = "SELECT * FROM account WHERE username = '$newUsername' AND username != '$username'";
        $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);

        if (mysqli_num_rows($checkUsernameResult) > 0) {
            echo "<script>alert('Username already exists. Please choose another one.'); 
                  document.location.href = 'profile.php';</script>";
            exit();
        }

        // สร้างคำสั่ง SQL สำหรับการอัปเดตข้อมูลผู้ใช้
        $updateQuery = "UPDATE account SET username = '$newUsername', password = '$newPassword' WHERE username = '$username'";
        
        // ทำการอัปเดตข้อมูล
        $result = mysqli_query($conn, $updateQuery);

        if ($result) {
            echo "<script>alert('Profile updated successfully'); 
                  document.location.href = 'profile.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error updating profile'); 
                  document.location.href = 'profile.php';</script>";
            exit();
        }
    } else {
        echo "Unable to connect to the database";
        exit();
    }
}

// ตรวจสอบการล็อกอินและการอัปโหลดรูปภาพ
if (isset($_FILES['profile_image']) && isset($_FILES['profile_image']['tmp_name']) && !empty($_FILES['profile_image']['tmp_name'])) {
    $username = $_SESSION['username']; // เพิ่มบรรทัดนี้

    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
    $file_extension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);

    // ตรวจสอบนามสกุลของไฟล์
    if (!in_array(strtolower($file_extension), $allowed_extensions)) {
        echo "<script>alert('Invalid file format. Please choose a valid image file.'); 
              document.location.href = 'profile.php';</script>";
        exit();
    }

    $upload_folder = 'path_to_upload_folder/';
    $uploaded_file = $upload_folder . basename($_FILES['profile_image']['name']);

    // ทำการอัปโหลดไฟล์
    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploaded_file)) {
        // สร้างคำสั่ง SQL สำหรับการอัปเดตข้อมูลรูปภาพในฐานข้อมูล
        $updateImageQuery = "UPDATE account SET profile_image = '$uploaded_file' WHERE username = '$username'";
        
        // ทำการอัปเดตข้อมูลรูปภาพ
        $resultImageUpdate = mysqli_query($conn, $updateImageQuery);

        if ($resultImageUpdate) {
            echo "<script>alert('Profile image updated successfully'); 
                  document.location.href = 'profile.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error updating profile image'); 
                  document.location.href = 'profile.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Error uploading image. Please try again later.'); 
              document.location.href = '';</script>";
        exit();
    }
}
