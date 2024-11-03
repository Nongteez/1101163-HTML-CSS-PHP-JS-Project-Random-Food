<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // เชื่อมต่อกับฐานข้อมูล
        $conn = new mysqli('localhost', 'root', '', 'kinraidee');
        
        if ($conn->connect_error) {
            die('Connection Failed: ' . $conn->connect_error);
        }

        // รับค่าอีเมลล์จากฟอร์ม
        $email = $_POST['email'];

        // ตรวจสอบว่ามีอีเมลล์นี้ในระบบหรือไม่
        $check_email_query = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($check_email_query);

        if ($result->num_rows > 0) {
            // ถ้ามีอีเมลล์นี้ในระบบ
            // ดำเนินการส่งอีเมลล์หรือลิ้งค์กู้คืนรหัสผ่านที่นี่
            // (ตัวอย่าง: ส่งอีเมลล์หรือลิ้งค์กู้คืนรหัสผ่านไปที่อีเมลล์ของผู้ใช้)

            // จำลองข้อความที่จะส่งไปยังอีเมลล์
            $reset_link = "http://example.com/reset_password.php?email=$email";
            $email_content = "Click the link below to reset your password: $reset_link";

            // จำลองการส่งอีเมลล์ (ในบางกรณีจะใช้ไลบรารีส่งอีเมลล์จริง)
            mail($email, 'Password Reset', $email_content);

            // ส่งผลรายการกลับไปยังหน้า forgot_password.php
            header('Location: forgot_password.php?reset=success');
        } else {
            // ถ้าไม่พบอีเมลล์นี้ในระบบ
            echo "Email not found. Please enter a valid email address.";
        }

        $conn->close();
    }
?>
