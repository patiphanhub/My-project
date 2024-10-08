<?php
// เริ่มต้นเซสชัน
session_start();

// ตั้งค่าการเชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "login_system";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $id_card_number = $_POST['id-card-number'];
    $full_name = $_POST['full-name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $province = $_POST['province'];
    $postal_code = $_POST['postal-code'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $birthdate = $_POST['birthdate'];

    // ตรวจสอบว่ามี username หรือ email อยู่แล้วหรือไม่
    $check_sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // ถ้าพบ username หรือ email ในระบบอยู่แล้ว
        echo "ชื่อผู้ใช้หรืออีเมลนี้ถูกใช้แล้ว";
    } else {
        // เพิ่มข้อมูลผู้ใช้ใหม่ในฐานข้อมูล
        $sql = "INSERT INTO users (id_card_number, full_name, gender, age, address, province, postal_code, phone, email, username, birthdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssisssssss", $id_card_number, $full_name, $gender, $age, $address, $province, $postal_code, $phone, $email, $username, $birthdate);

        if ($stmt->execute()) {
            // สมัครสมาชิกสำเร็จ
            echo "สมัครสมาชิกสำเร็จ!";
        } else {
            echo "เกิดข้อผิดพลาดในการสมัครสมาชิก";
        }
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
