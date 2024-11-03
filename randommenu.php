<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kin Rai Dee</title>
    <link rel="stylesheet" href="randommenu.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt">
    <link rel="icon" type="image/x-icon" href="PIC\LogoWeb.png">
    <!-- ใส่ในส่วน <script> ของหน้า HTML -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // กำหนด URL ของไฟล์ PHP ที่จะใช้ดึงข้อมูลสุ่ม
            const randomDataUrl = "randommenu_db.php";

            // กำหนด Element ที่จะแสดงข้อมูล
            const foodTypeElement = document.getElementById("foodtype");
            const shopNameElement = document.getElementById("shopname");
            const addressElement = document.getElementById("address");
            const linkMapsElement = document.getElementById("linkmaps-url");
            const foodImageElement = document.getElementById("foodImage");
    foodImageElement.addEventListener("click", function() {
        const linkMapsUrl = linkMapsElement.href;  // ดึง URL จาก Element linkMaps
        window.open(linkMapsUrl, "_blank");  // เปิดหน้าต่างหรือแถบใหม่
    });

            // Event Listener สำหรับปุ่ม "Get Random Food"
            const btnElement = document.getElementById("btn");
            btnElement.addEventListener("click", function() {
                // ส่งคำขอดึงข้อมูลไปที่ไฟล์ PHP
                fetch(randomDataUrl)
                    .then(response => response.json())
                    .then(data => {
                        // แสดงข้อมูลที่ได้ใน Element ที่กำหนด
                        foodTypeElement.textContent = `ประเภทอาหาร : ${data.foodtype}`;
                        shopNameElement.textContent = `ชื่อร้านอาหาร : ${data.shopname}`;
                        addressElement.textContent = `ที่อยู่ : ${data.address}`;

                        // แสดงรูปภาพ
                        foodImageElement.src = "img/" + data.image;
                        // กำหนดขนาดรูปภาพ
                        foodImageElement.width = 500;
                        foodImageElement.height = 500;

                        // สร้างลิงก์ URL และแสดงข้อมูล Link Maps
                        const linkMapsUrl = data.linkmaps;
                        linkMapsElement.textContent = linkMapsUrl;
                        linkMapsElement.href = linkMapsUrl;  // กำหนด href ของลิงก์
                    })
                    .catch(error => {
                        console.error("Error fetching random data:", error);
                        foodTypeElement.textContent = "Error fetching random data. Please try again.";
                        shopNameElement.textContent = "";
                        addressElement.textContent = "";
                        linkMapsElement.textContent = "";
                        linkMapsElement.href = "";  // ลบลิงก์เมื่อไม่มีข้อมูล
                        foodImageElement.src = "";  
                    });
            });
        });
    </script>



</head>

<body>
    
<?php include 'navbar.php'; ?> 
    <div class=hide>hide</div>
       
    <div class="main-content">
    <div class="content-wrapper">
    <span>🍔</span>
    <img id="foodImage" src="" alt="Food Image">
    <div id="foodDetails">
        <p id="foodtype">Food Type: </p>
        <p id="shopname">Shop Name: </p>
        <p id="address">Address: </p>
        <p id="linkmaps">Link Maps: <a href="#" id="linkmaps-url" target="_blank"></a></p>
    </div>
    <button id="btn">GET RANDOM FOOD🎲</button>
</div>

   <!-- randommenu.php -->

   <div class=hide>hide</div>


    
</body>
</html>