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

$success = false; // ตัวแปรสำหรับเก็บสถานะการอัปเดตข้อมูล

// ตรวจสอบเมื่อฟอร์มถูกส่งมา
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $province = $_POST['province'];
    $postal_code = $_POST['postal_code'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // อัปเดตข้อมูลผู้ใช้ในฐานข้อมูล
    $sql = "UPDATE users SET full_name = ?, age = ?, address = ?, province = ?, postal_code = ?, phone = ?, email = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissssss", $full_name, $age, $address, $province, $postal_code, $phone, $email, $username);
    
    if ($stmt->execute()) {
        $success = true; // กำหนดให้เป็น true เมื่ออัปเดตสำเร็จ
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . $conn->error;
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลส่วนตัว</title>
    <link rel="stylesheet" href="../Css/edit_profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container">
        <h1>แก้ไขข้อมูลส่วนตัว</h1>
        <form action="edit_profile.php" method="POST">
            <label for="full_name">ชื่อ – นามสกุล:</label>
            <input type="text" name="full_name" id="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>

            <label for="age">อายุ:</label>
            <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($user['age']); ?>" required>

            <label for="address">ที่อยู่:</label>
            <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>

            <label for="province">จังหวัด:</label>
            <input type="text" name="province" id="province" value="<?php echo htmlspecialchars($user['province']); ?>" required>

            <label for="postal_code">รหัสไปรษณีย์:</label>
            <input type="text" name="postal_code" id="postal_code" value="<?php echo htmlspecialchars($user['postal_code']); ?>" required>

            <label for="phone">เบอร์โทรศัพท์:</label>
            <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>

            <label for="email">อีเมลล์:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <button type="submit" class="btn-edit">บันทึกการเปลี่ยนแปลง</button>
        </form>
        <a href="profile.php" class="btn-logout">กลับไปที่โปรไฟล์</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <?php if ($success): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'อัปเดตข้อมูลเรียบร้อยแล้ว',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    <?php endif; ?>
</body>
</html>
