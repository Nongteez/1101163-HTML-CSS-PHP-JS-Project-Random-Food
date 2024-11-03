-- สร้างฐานข้อมูล
CREATE DATABASE IF NOT EXISTS your_database_name;
USE your_database_name;

-- สร้างตารางสำหรับเก็บข้อมูลอาหาร
CREATE TABLE IF NOT EXISTS foods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    -- เพิ่มคอลัมน์เพิ่มเติมตามความต้องการ
);

-- เพิ่มข้อมูลอาหารตัวอย่าง
INSERT INTO foods (name, description, image_url) VALUES
    ('ชื่ออาหารที่ 1', 'คำอธิบายอาหารที่ 1', 'url_รูปภาพ_1.jpg'),
    ('ชื่ออาหารที่ 2', 'คำอธิบายอาหารที่ 2', 'url_รูปภาพ_2.jpg'),
    -- เพิ่มรายการอาหารตามต้องการ
;
