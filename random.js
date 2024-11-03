document.addEventListener("DOMContentLoaded", function() {
    // ...
// random.js

// ตรวจสอบการเลื่อนหน้า
window.addEventListener('scroll', function() {
    var scrollBtnContainer = document.querySelector('.scroll-btn-container');
    if (window.scrollY > 300) {
        scrollBtnContainer.classList.add('show-btn');
    } else {
        scrollBtnContainer.classList.remove('show-btn');
    }
});

// ฟังก์ชันเลื่อนขึ้น
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

    // Event Listener สำหรับปุ่ม "Get Random Food"
    const btnElement = document.getElementById("btn");
    btnElement.addEventListener("click", function() {
        // ส่งคำขอดึงข้อมูลไปที่ไฟล์ PHP
        fetch(randomDataUrl)
            .then(response => response.json())
            .then(data => {
                // แสดงข้อมูลที่ได้ใน Element ที่กำหนด
                foodTypeElement.textContent = `Food Type: ${data.foodtype}`;
                shopNameElement.textContent = `Shop Name: ${data.shopname}`;
                addressElement.textContent = `Address: ${data.address}`;

                // แสดงรูปภาพ
                foodImageElement.src = "img/" + data.image;
                // กำหนดขนาดรูปภาพ
                foodImageElement.width = 500;
                foodImageElement.height = 500;

                // สร้างลิงก์ URL และแสดงข้อมูล Link Maps
                const linkMapsUrl = data.linkmaps;
                linkMapsElement.innerHTML = `Link Maps: <a href="${linkMapsUrl}" id="linkmaps-url" target="_blank">${linkMapsUrl}</a>`;
            })
            .catch(error => {
                console.error("Error fetching random data:", error);
                foodTypeElement.textContent = "Error fetching random data. Please try again.";
                shopNameElement.textContent = "";
                addressElement.textContent = "";
                linkMapsElement.innerHTML = "";  // ลบลิงก์เมื่อไม่มีข้อมูล
                foodImageElement.src = "";  
            });
    });
});

