<?php
// เริ่มต้นเซสชัน
session_start();

// ตั้งค่า header สำหรับการตอบกลับเป็น JSON
header('Content-Type: application/json');

// ตรวจสอบการเข้าสู่ระบบ
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'ยังไม่ได้เข้าสู่ระบบ']);
    exit();
}

// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'การเชื่อมต่อล้มเหลว: ' . $conn->connect_error]);
    exit();
}

// รับข้อมูลผู้ใช้
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo json_encode(['success' => false, 'message' => 'ไม่พบข้อมูลผู้ใช้']);
    exit();
}

// ตรวจสอบว่ามีการอัปโหลดไฟล์
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
    $target_dir = "uploads/";
    // สร้างชื่อไฟล์ใหม่เพื่อป้องกันชื่อไฟล์ซ้ำและปัญหาด้านความปลอดภัย
    $new_filename = uniqid() . '.' . strtolower(pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . $new_filename;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // ตรวจสอบว่ามีไฟล์ที่เป็นภาพหรือไม่
    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if ($check === false) {
        echo json_encode(['success' => false, 'message' => 'ไฟล์นี้ไม่ใช่รูปภาพ']);
        exit();
    }

    // ตรวจสอบรูปแบบไฟล์ (JPEG, PNG, GIF)
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_types)) {
        echo json_encode(['success' => false, 'message' => 'อนุญาตเฉพาะไฟล์ JPG, JPEG, PNG และ GIF เท่านั้น']);
        exit();
    }

    // ตรวจสอบขนาดไฟล์ (เช่นไม่เกิน 5MB)
    if ($_FILES["profile_image"]["size"] > 5000000) {
        echo json_encode(['success' => false, 'message' => 'ไฟล์มีขนาดใหญ่เกินไป']);
        exit();
    }

    // ย้ายไฟล์ไปยังโฟลเดอร์ที่ระบุ
    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
        // อัปเดตฐานข้อมูลด้วยเส้นทางไฟล์ใหม่
        $sql = "UPDATE users SET image = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $target_file, $username);
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'image_path' => $target_file]);
        } else {
            echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการอัปโหลดไฟล์']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ไม่มีการอัปโหลดไฟล์']);
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
