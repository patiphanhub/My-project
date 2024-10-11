<?php
// เริ่มต้นเซสชัน
session_start();

// ตั้งค่าการเชื่อมต่อกับฐานข้อมูล
$servername = "localhost";  // เปลี่ยนเป็น server ของคุณหากจำเป็น
$db_username = "root";       // username ของฐานข้อมูล MySQL (ปกติคือ root)
$db_password = "";           // รหัสผ่านของ MySQL (ถ้ามี)
$dbname = "login_system";    // ชื่อฐานข้อมูลที่สร้าง

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// ตรวจสอบว่ามีการส่งข้อมูลจากแบบฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // คำสั่ง SQL ในการดึงข้อมูลผู้ใช้
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // ตรวจสอบว่าพบข้อมูลผู้ใช้หรือไม่
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // ตรวจสอบว่ารหัสผ่านตรงกันหรือไม่
        if ($password == $user['password']) {
            // ล็อกอินสำเร็จ
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id']; // เก็บ user_id ใน session
            $_SESSION['username'] = $user['username']; // เก็บชื่อผู้ใช้ใน session
            header("Location: profile.php");
            exit();
        } else {
            // รหัสผ่านไม่ถูกต้อง
            $error = "รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        // ไม่พบชื่อผู้ใช้ในฐานข้อมูล
        $error = "ไม่พบชื่อผู้ใช้";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>เข้าสู่ระบบ</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="width: 400px; border-radius: 20px;">
            <h5 class="card-title text-center mb-4">เข้าสู่ระบบ</h5>

            <?php if (isset($error)) : ?>
                <p class="text-danger text-center"><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="username">ชื่อผู้ใช้</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="กรุณากรอกชื่อผู้ใช้" required>
                </div>
                <div class="form-group">
                    <label for="password">รหัสผ่าน</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="กรุณากรอกรหัสผ่าน" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
                <p class="text-center form-switch">ยังไม่มีบัญชี? <a href="register.php">สมัครสมาชิก</a></p>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body>
</html>
