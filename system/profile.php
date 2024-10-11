<?php
// เริ่มต้นเซสชัน
session_start();

// ตรวจสอบการเข้าสู่ระบบ
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // เปลี่ยนไปยังหน้าเข้าสู่ระบบถ้ายังไม่เข้าสู่ระบบ
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
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// รับข้อมูลผู้ใช้จากฐานข้อมูล
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "ไม่พบข้อมูลผู้ใช้";
    exit();
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลส่วนตัว</title>
    <link rel="stylesheet" href="../Css/profile.css">
</head>
<body>
    <div class="container">
        <h1>ข้อมูลส่วนตัว</h1>
        <div class="profile-info">
            <p><strong>เลขบัตรประชาชน:</strong> <?php echo htmlspecialchars($user['id_card_number']); ?></p>
            <p><strong>ชื่อ – นามสกุล:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
            <p><strong>เพศ:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
            <p><strong>อายุ:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
            <p><strong>ที่อยู่:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
            <p><strong>จังหวัด:</strong> <?php echo htmlspecialchars($user['province']); ?></p>
            <p><strong>รหัสไปรษณีย์:</strong> <?php echo htmlspecialchars($user['postal_code']); ?></p>
            <p><strong>เบอร์โทรศัพท์:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
            <p><strong>อีเมลล์:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>ผู้ใช้งาน:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        </div>

        <!-- ปุ่มแก้ไขข้อมูล -->
        <a href="edit_profile.php" class="btn-edit">แก้ไขข้อมูล</a>
        
        <!-- ปุ่มลบข้อมูล -->
        <form action="person.php">
            <button type="submit" class="btn-person">ไปเลือกบุคคล</button>
        </form>

        <!-- ปุ่มออกจากระบบ -->
        <a href="logout.php" class="btn-logout">ออกจากระบบ</a>
    </div>
</body>
</html>
