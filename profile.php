<?php
session_start();
require 'connection.php';

function getProfileImagePath($username, $conn) {
    $sql = "SELECT profile_image FROM account WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['profile_image'] ?? "path_to_default_image/default_profile_image.png";
    } else {
        return "path_to_default_image/default_profile_image.png";
    }
}

$currentImagePath = getProfileImagePath($_SESSION['username'], $conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kin Rai Dee</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt">
    <link rel="icon" type="image/x-icon" href="PIC\LogoWeb.png">
    <!-- Include CSS and other head details -->
    <style>
        html, body {
            font-family: 'Prompt', sans-serif !important;
        }
    </style>
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="buttonclick" style="margin-top: 20px;">
    <button class="button" onclick="window.location.href='index.php'">
        <p>Home</p>
    </button>

    <button class="button" onclick="window.location.href='addmenu.php'">
        <p>Addmenu</p>
    </button>

    <button class="button" onclick="window.location.href='data.php'">
        <p>Data</p>
    </button>

    <button class="button" onclick="window.location.href='index.php'">
        <p>Random</p>
    </button>

    <button class="button" onclick="window.location.href='index.php'">
        <p>Other</p>
    </button>
</div>
<!-- ในส่วนของ HTML -->
<div class="profile-container">
<!-- แสดงรูปภาพปัจจุบัน -->
<?php
    // ตรวจสอบว่ายังไม่ได้ประกาศ getProfileImagePath() ก่อน
    if (!function_exists('getProfileImagePath')) {
        // เพิ่มฟังก์ชันนี้ไปในตอนท้ายของไฟล์หรือในไฟล์ connection.php
        function getProfileImagePath($username, $conn) {
            $sql = "SELECT profile_image FROM account WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                return $row['profile_image'];
            } else {
                return "path_to_default_image/default_profile_image.png";
            }
        }
    }

    // แสดงรูปภาพปัจจุบัน
    $currentImagePath = getProfileImagePath($_SESSION['username'], $conn);
    echo '<img class="profile-image" src="' . $currentImagePath . '" alt="Profile Image">';
?>

<?php
$username = $_SESSION['username'];
$sql = "SELECT profile_image FROM account WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $uploadedImagePath = $row['profile_image'];
}
?>
<form action="update_profile.php" method="post" enctype="multipart/form-data">
    <input type="file" name="profile_image" accept="image/*">
    <button type="submit">Save Changes</button>
</form>


    <!-- แสดงรูปภาพในฐานข้อมูล -->
    <?php
    $username = $_SESSION['username'];
    $sql = "SELECT profile_image FROM account WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $uploadedImagePath = $row['profile_image'];

       
    }
    ?>

    <!-- ในส่วนของ CSS -->
    <style>
        .profile-image {
            width: 150px; /* ปรับขนาดรูปภาพตามที่คุณต้องการ */
            height: 150px;
            border-radius: 50%; /* ทำให้รูปภาพเป็นวงกลม */
            object-fit: cover; /* ปรับเพื่อให้รูปภาพทำการปรับขนาดให้พอดีกับพื้นที่ที่กำหนด */
            margin-bottom: 20px;
        }
    </style>
</div>


<div class="profile-container">
<?php
    require 'connection.php';

    // ตรวจสอบการล็อกอิน
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $sql = "SELECT role FROM account WHERE username = '$username'";

        if ($conn) {
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $userData = mysqli_fetch_assoc($result);

                if ($userData) {
                    $role = $userData['role'];

                    // แสดงข้อความต้อนรับตาม Role
                    switch ($role) {
                        case 'u':
                            echo '<h2>Welcome, ' . $_SESSION['username'] . '! User</h2>';
                            break;
                        case 's':
                            echo '<h2>Welcome, ' . $_SESSION['username'] . '! Store</h2>';
                            break;
                        case 'a':
                            echo '<h2>Welcome, ' . $_SESSION['username'] . '! Admin</h2>';
                            break;
                        default:
                            echo '<h2>Welcome, ' . $_SESSION['username'] . '! ' . $role . '</h2>';
                            break;
                    }

                    // แสดงแบบฟอร์มแก้ไขโปรไฟล์
                    echo '
                        <div id="edit_profile" class="edit-profile-container">
                            <h3>Edit Your Profile</h3>
                            <form action="update_profile.php" method="post">
                                <input type="text" name="new_username" placeholder="New Username">
                                <input type="password" name="new_password" placeholder="New Password">
                                <input type="password" name="confirm_password" placeholder="Confirm Password">
                                <button type="submit">Save Changes</button>
                            </form>
                        </div>';
                } else {
                    echo "<script>alert ('User not found'); 
                          document.location.href = 'register_and_login.php';</script>";
                    exit();
                }
            } else {
                echo "Unable to fetch user data";
                exit();
            }
        } else {
            echo "Unable to connect to the database";
            exit();
        }
    } else {
        echo "<script>alert ('User not logged in'); 
              document.location.href = 'register_and_login.php';</script>";
        exit();
    }
?>

</div>
</div>

</body>
</html>
