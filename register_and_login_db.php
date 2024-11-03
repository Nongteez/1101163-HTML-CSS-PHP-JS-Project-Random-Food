<?php
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// ตรวจสอบความยาวของรหัสผ่าน
if (strlen($password) < 6) {
    echo "Password must be at least 6 characters long.";
} else {
    $conn = new mysqli('localhost', 'root', '', 'kinraidee');

    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    } else {
        // ตรวจสอบว่ามีชื่อผู้ใช้นี้หรืออีเมลนี้ในระบบแล้วหรือไม่
        $check_user_query = "SELECT * FROM account WHERE username = '$username' OR email = '$email'";
        $result = $conn->query($check_user_query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['username'] == $username) {
                    echo "<script> alert ('Username already exists. Please choose another username.'); 
                    document.location.href = 'register_and_login.php';
                   </script>";
                }
                if ($row['email'] == $email) {
                    echo "<script> alert ('Email already in use. Please choose another email.'); 
                    document.location.href = 'register_and_login.php';
                   </script>";
                }
            }
        } else {
            // เพิ่มข้อมูล
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO account (email, username, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $email, $username, $hashed_password, $role);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "<script> alert ('Registration Success...'); 
                    document.location.href = 'register_and_login.php';
                </script>";
            } else {
                echo "<script> alert ('Registration Failed. Please try again...'); 
                    document.location.href = 'register_and_login.php';
                </script>";
            }

            $stmt->close();
        }

        $conn->close();
    }
}
?>
