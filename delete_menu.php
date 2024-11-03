<?php
require 'addmenu_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    
    $delete_query = "DELETE FROM addmenu WHERE id = $id";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        echo "<script>alert('ลบเมนูเรียบร้อยแล้ว'); document.location.href = 'data.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการลบข้อมูล'); document.location.href = 'data.php';</script>";
    }
}
?>
