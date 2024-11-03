<?php
// กำหนดค่าของฐานข้อมูล MySQL
$hostname = "localhost";
$username = "username"; // ต้องเปลี่ยนเป็นชื่อผู้ใช้ MySQL ที่ถูกต้อง
$password = "password"; // ต้องเปลี่ยนเป็นรหัสผ่าน MySQL ที่ถูกต้อง
$database = "kinraidee";
$role = "role";
$profile_image = "profile_image";

// เชื่อมต่อกับ MySQL
$conn = new mysqli('localhost', 'root', '', 'kinraidee');

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
