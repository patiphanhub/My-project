<?php
session_start();

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบแล้วหรือยัง
if (!isset($_SESSION['user_id'])) {
    echo "กรุณาล็อกอินก่อนทำการจ้างงาน";
    exit();
}

// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $db_password, $dbname);

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// รับข้อมูลจาก POST
$person_id = isset($_POST['person_id']) ? (int)$_POST['person_id'] : 0;
$user_id = $_SESSION['user_id']; // รับ user_id จาก session ของผู้ใช้ที่ล็อกอิน

// ข้อมูลจำลองบุคคลที่จ้าง (ใช้เชื่อมต่อฐานข้อมูลได้จริงหากต้องการ)
$persons = [
    1 => ["name" => "สมชาย ใจดี", "address" => "123/45 ถนนสุขสบาย", "phone" => "080-123-4567"],
    2 => ["name" => "สมหญิง ประหยัดทรัพย์", "address" => "789/99 ซอยสบายใจ", "phone" => "081-987-6543"],
    3 => ["name" => "สมปอง รวยทรัพย์", "address" => "456/78 หมู่บ้านหรู", "phone" => "082-456-7890"]
];

// ตรวจสอบว่า person_id นั้นมีอยู่หรือไม่
if (!isset($persons[$person_id])) {
    echo "ไม่พบข้อมูลบุคคล";
    exit();
}

$person = $persons[$person_id];

// บันทึกข้อมูลการจ้างลงในตาราง hire_history
$stmt = $conn->prepare("INSERT INTO hire_history (user_id, full_name, hire_date) VALUES (?, ?, NOW())");
$stmt->bind_param("is", $user_id, $person['name']);

if ($stmt->execute()) {
    // เมื่อบันทึกสำเร็จ นำผู้ใช้ไปยังหน้าแสดงประวัติการจ้าง
    header("Location: hire_history.php");
    exit();
} else {
    echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
