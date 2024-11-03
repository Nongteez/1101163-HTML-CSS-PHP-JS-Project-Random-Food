<?php
$conn = new mysqli('localhost', 'root', '', 'kinraidee');

if ($conn->connect_error) {
    die('การเชื่อมต่อล้มเหลว: ' . $conn->connect_error);
}

$query = "SELECT * FROM addmenu ORDER BY RAND() LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    // ใช้ JSON_UNESCAPED_UNICODE เพื่อให้มีการแสดงผลเป็นภาษาไทย
    echo json_encode($row, JSON_UNESCAPED_UNICODE);
} else {
    $error_message = "Error: " . mysqli_error($conn);
    error_log($error_message, 0);  // 0 คือ LOG_ERR
    echo json_encode(["error" => "ไม่สามารถดึงข้อมูลได้"], JSON_UNESCAPED_UNICODE);
}

$conn->close();
?>
