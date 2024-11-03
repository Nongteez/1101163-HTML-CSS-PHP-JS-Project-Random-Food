<?php
     session_start();

    // ตรวจสอบการเชื่อมต่อฐานข้อมูล
    $conn = new mysqli('localhost', 'root', '', 'kinraidee');

    if ($conn->connect_error) {
        die('การเชื่อมต่อล้มเหลว: ' . $conn->connect_error);
    }

    // ดึงข้อมูลจากฐานข้อมูล
    $result = mysqli_query($conn, "SELECT * FROM addmenu ORDER BY RAND() LIMIT 5");

    $menuData = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $menuData[] = $row;
    }

    // ตรวจสอบสถานะการล็อกอิน
if (isset($_SESSION['username'])) {
    // ถ้า login แล้ว
    $randomButtonLink = 'randommenu.php';
    $randomImageSource = '\KINRAIDEE VS\PIC\YourNewImage.png'; // เปลี่ยน YourNewImage.png เป็นชื่อไฟล์รูปภาพที่คุณต้องการให้แสดง
    $randomButtonText = 'RANDOM MENU'; // เปลี่ยนข้อความปุ่มตามที่คุณต้องการ
} else {
    // ถ้ายังไม่ login
    $randomButtonLink = 'register_and_login.php';
    $randomImageSource = '\KINRAIDEE VS\PIC\LogoWeb.png';
    $randomButtonText = 'RANDOM!';
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kin Rai Dee</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt">
    <link rel="icon" type="image/x-icon" href="PIC\LogoWeb.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

 
    <style>
        html, body {
            font-family: 'Prompt', sans-serif !important;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var button = document.querySelector('.button');

            button.addEventListener('click', function () {
            // เพิ่มหรือลบคลาส "shake" เพื่อทำให้ปุ่มสั่นๆ
            button.classList.add('shake');

            // ใช้ setTimeout เพื่อลบคลาส "shake" หลังจากทำ animation เสร็จ
            setTimeout(function () {
                button.classList.remove('shake');
            }, 500); // 0.5 วินาที (ตรงกับค่า duration ใน CSS)
            });
        });
</script>
    <!-- กดรูปภาพแล้วเลื่อนลง -->
    <style>
            .box3 {
                cursor: pointer;
            }
        </style>
        <script>
            function scrollDown() {
                // เลือกองค์ประกอบที่ต้องการเลื่อนลง
                const box3Element = document.querySelector('.box3');

                // เรียกใช้คำสั่ง scrollIntoView เพื่อเลื่อนลง
                box3Element.scrollIntoView({ behavior: 'smooth' });
            }
        </script>
 <style>
        .scroll-btn-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
        }

        .scroll-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #FF8C56;
            color: white;
            font-size: 20px;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
        }
    </style>
    <script>
        function scrollToTop() {
            // เรียกใช้คำสั่ง scrollIntoView เพื่อเลื่อนขึ้นไปบนสุด
            document.body.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    </script>


</head>
<body>

<?php include 'navbar.php'; ?>

    
    </div>
    <div class="main2-content">
        <div class="box2">
        <a href="<?php echo $randomButtonLink; ?>">
        <img class="image2"  src="\KINRAIDEE VS\PIC\LogoWeb.png"  src="<?php echo $randomImageSource; ?>" alt="Logo">
    </a>
    <h2></h2>
    <p></p>
    <a class="button" href="<?php echo $randomButtonLink; ?>"><?php echo $randomButtonText; ?></a>
        
        </div>

        <div class="main2-content">
        <div class="box3" onclick="scrollDown()">
            <a>
                <img class="image3" src="\KINRAIDEE VS\PIC\recom3.png" alt="Logo">
            </a>
        </div>
    </div>


        <!-- ---------Pop up ads--------- -->
        <div id="ads-popup"><style type="text/css">
            #ads_fix_footer{width:1000px;margin:auto}#ads_fox_bottom{bottom:0;display:block;min-height:40px;position:fixed;text-align:center;z-index:50000;width:50%}@media (min-width:1281px){#fix_footer img,#fix_footer2 img{background-repeat:no-repeat;background-size:contain}#fix_footer2 img{width:600px;height:90px}#fix_footer img{width:26px;height:26px;margin-left:60px}}@media (min-width:1025px) and (max-width:1280px){#fix_footer img,#fix_footer2 img{background-repeat:no-repeat;background-size:contain}#fix_footer2 img{width:600px;height:90px}#fix_footer img{width:26px;height:26px;margin-left:60px}}@media (min-width:768px) and (max-width:1024px){#fix_footer img,#fix_footer2 img{background-repeat:no-repeat;background-size:contain}#fix_footer2 img{width:600px;height:90px}#fix_footer img{width:26px;height:26px;margin-left:30px}}@media (min-width:768px) and (max-width:1024px) and (orientation:landscape){#fix_footer img,#fix_footer2 img{background-repeat:no-repeat;background-size:contain}#fix_footer2 img{width:600px;height:90px}#fix_footer img{width:26px;height:26px;margin-left:30px}}@media (min-width:481px) and (max-width:767px){#fix_footer img,#fix_footer2 img{background-repeat:no-repeat;background-size:contain}#fix_footer2 img{width:600px;height:90px}#fix_footer img{width:26px;height:26px;margin-left:30px}}@media (min-width:320px) and (max-width:480px){#fix_footer img,#fix_footer2 img{background-repeat:no-repeat;background-size:contain}#fix_footer2 img{width:600px;height:90px}#fix_footer img{width:26px;height:26px;margin-left:30px}}
            #ads_fox_bottom {
                display: flex;
                justify-content: center;
                align-items: center;
                position: fixed;
                bottom: 0;
                 width: 100%;
                z-index: 50000;
                }

            #ads_fix_footer {
                width: 1000px;
                /* ปรับตามความต้องการ */
                margin: auto;
                }
            </style>

                <div id="ads_fox_bottom">
                <div id="ads_fix_footer">

                    <!-- Start iMG Close Banner -->
                    <div style="text-align:center;">
                        <div id="fix_footer" class="closed" style="width: 26px; height: 0px; display: -webkit-inline-box; margin: 0px 0px 0px 510px; cursor: pointer;" onclick="hide();">
                            <img src="https://www.037hdmovie.com/Banner/ezgif-1-61f5c6d7ba32.png" alt="close advertisement" style="padding: -2px;">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <!-- End IMG Close Banner -->


                    <!-- Start Fix Footer Banner -->
                    <div id="fix_footer2" style="width:1000px;display:block;float:left;margin: -7px 0 10px 0;overflow:hidden;line-height:0px;">
                            <div style="display:inline-block; width:1000px; text-align:center;"><a href="www.google.com" title="" target="_blank">
                                    <img src="\KINRAIDEE VS\PIC\Kuyteay.png" height="100%" width="250"></a>
                            </div>
                        </div>
                    <div class="clear"></div>
                    <!-- END Fix Footer Banner -->

                </div>
                </div>

                <script type="text/javascript">
                    function hide() {
                        document.getElementById("ads_fix_footer").style.display = "none";
                    }
                </script></div>
         <!-- ---------Pop up ads--------- -->
        
         <div class="main-content">
    <?php foreach ($menuData as $menu): ?>
        <div class="box">
            <!-- เพิ่มลิงก์ไปยัง linkmaps ที่คุณต้องการ โดยให้เพิ่มลิงก์เป็นค่าที่มาจากฐานข้อมูลตามที่คุณต้องการ -->
            <a href="<?php echo $menu['linkmaps']; ?>" target="_blank" >
                <img class="image" src="img/<?php echo $menu['image']; ?>" alt="Menu Image">
                <h2><?php echo $menu['foodtype']; ?></h2>
                <p><?php echo $menu['shopname']; ?></p>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<div class=hide>hide</div>

<div class="footer">
    <p>&copy; 2024 Kin Rai Dee. All rights reserved.</p>
    <p>Suranaree University of Technology, 111 Nakhon Ratchasima Province</p>
    <p>Email: Kinraidee@gmail.com</p>
    <!-- เพิ่ม Social Icons -->
    <div class="social-icons">
        <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
        <!-- เพิ่ม Social Icons ตามที่คุณต้องการ -->
    </div>
</div>



 <!-- ปุ่มและไอคอนเลื่อนขึ้น -->
 <div class="scroll-btn-container">
        <div class="scroll-btn" onclick="scrollToTop()">▲</div>
    </div>

    
    </body>
</html>    