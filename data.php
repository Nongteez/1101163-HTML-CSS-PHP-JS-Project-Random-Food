<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'addmenu_db.php';

$conn = new mysqli('localhost', 'root', '', 'kinraidee');

if ($conn->connect_error) {
    die('การเชื่อมต่อล้มเหลว: ' . $conn->connect_error);
}

// ตรวจสอบการลบข้อมูล
if(isset($_POST["delete"])) {
    $idToDelete = $_POST["id"];

    $result = mysqli_query($conn, "SELECT image FROM addmenu WHERE id = $idToDelete");
    $row = mysqli_fetch_assoc($result);
    $imageToDelete = $row['image'];

    $deleteQuery = "DELETE FROM addmenu WHERE id = $idToDelete";
    mysqli_query($conn, $deleteQuery);

    if ($imageToDelete) {
        $filePath = 'img/' . $imageToDelete;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    header("Location: data.php");
    exit();
}

include("connection.php");

// ตรวจสอบ session
if (isset($_SESSION['username'])) {
    $role = '';

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

    // ตรวจสอบสิทธิและกำหนดการเข้าถึง
    switch ($role) {
        case 'u':
        case 's':
          
            echo "<script> alert ('คุณไม่มีสิทธิ์ในการเข้าถึงหน้านี้'); 
        document.location.href = 'index.php';
    </script>";
            exit();
            break;
        case 'a':
            // สิทธิของผู้ดูแลระบบ (Admin)
            // ทำตามที่คุณต้องการ
            break;
        default:
            echo "<script> alert ('คุณไม่มีสิทธิ์ในการเข้าถึงหน้านี้'); 
            document.location.href = 'index.php';
        </script>";
            exit();
            break;
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
    <link rel="stylesheet" href="data.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt">
    <link rel="icon" type="image/x-icon" href="PIC\LogoWeb.png">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td>#</td>
            <td>Food Type</td>
            <td>Shop Name</td>
            <td>Address</td>
            <td>Link Maps</td>
            <td>Image</td>
            <td>Action</td>
        </tr>
        <?php 
        $i = 1;
        $rows = mysqli_query($conn, "SELECT * FROM addmenu ORDER BY id DESC");

        foreach($rows as $row) : ?>
            <tr>
                <td><?php echo $i++; ?> </td>
                <td><?php echo $row["foodtype"]; ?> </td>
                <td><?php echo $row["shopname"]; ?> </td>
                <td><?php echo $row["address"]; ?> </td>
                <td><?php echo $row["linkmaps"]; ?> </td>
                <td> 
                    <img src="img/<?php echo $row['image']?>" width=200 title="<?php echo $row['image']; ?>"> 
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="Addmenu.php">Add menu</a>
</body>
</html>
