<?php

if (isset($_POST["submit"])) {
    $foodtype = $_POST["foodtype"];
    $shopname = $_POST["shopname"];
    $address = $_POST["address"];
    $linkmaps = $_POST["linkmaps"];

    if ($_FILES["image"]["error"] === 4) {
        echo "<script> alert ('ไม่พบรูปภาพ'); 
                               document.location.href = 'addmenu.php';
                              </script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png', 'gif'];
        $imageExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script> alert ('รูปภาพไม่ถูกต้อง'); 
                               document.location.href = 'addmenu.php';
                              </script>";
        } else if ($fileSize > 1000000) {
            echo "<script> alert ('รูปภาพของคุณใหญ่เกินไป'); 
                               document.location.href = 'addmenu.php';
                              </script>";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            $uploadDir = 'img/';

            // สร้างไดเรกทอรีหากยังไม่มี
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (move_uploaded_file($tmpName, $uploadDir . $newImageName)) {
                // เชื่อมต่อฐานข้อมูล
                $conn = new mysqli('localhost', 'root', '', 'kinraidee');

                if ($conn->connect_error) {
                    die('การเชื่อมต่อล้มเหลว: ' . $conn->connect_error);
                } else {
                    // เพิ่มข้อมูลลงในฐานข้อมูล
                    $query = "INSERT INTO addmenu (foodtype, shopname, address, linkmaps, image) 
                              VALUES('$foodtype', '$shopname', '$address', '$linkmaps', '$newImageName')";

                    mysqli_query($conn, $query);

                    if (mysqli_affected_rows($conn) > 0) {
                        echo "<script> alert ('เพิ่มเมนูเรียบร้อยแล้ว'); 
                               document.location.href = 'addmenu.php';
                              </script>";
                    } else {
                        echo "<script> alert ('เกิดข้อผิดพลาดในการเพิ่มข้อมูลลงในฐานข้อมูล'); </script>";
                    }

                    $conn->close();
                }
            } else {
                echo "<script> alert ('เกิดข้อผิดพลาดในการอัปโหลดไฟล์'); </script>";
            }
        }
    }
}
?>