<?php
// login_status.php

// เริ่ม session ถ้ายังไม่มี
if (!isset($_SESSION)) {
    session_start();
}

$response = [
    'status' => 'success',
    'logged_in' => isset($_SESSION['username']),
];

// ตั้งค่า header เพื่อระบุว่าไฟล์นี้จะส่งข้อมูลในรูปแบบ JSON
header('Content-Type: application/json');

// แปลง array เป็น JSON และแสดงผล
echo json_encode($response);
?>
