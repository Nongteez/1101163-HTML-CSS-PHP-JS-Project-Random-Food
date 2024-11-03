<?php
// your_login_backend_script.php

// เริ่ม session ถ้ายังไม่มี
session_start();

// ตรวจสอบสถานะการล็อกอิน
if (isset($_SESSION['username'])) {
    $response = [
        'status' => 'success',
        'logged_in' => true,
    ];
} else {
    $response = [
        'status' => 'success',
        'logged_in' => false,
    ];
}

// ตั้งค่า header เพื่อระบุว่าไฟล์นี้จะส่งข้อมูลในรูปแบบ JSON
header('Content-Type: application/json');

// แปลง array เป็น JSON และแสดงผล
echo json_encode($response);
?>
