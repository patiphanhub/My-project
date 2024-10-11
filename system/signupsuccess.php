<?php
// เริ่มต้นเซสชัน
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Css/success.css">
    <title>สมัครสมาชิกสำเร็จ</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="width: 400px; border-radius: 20px;">
            <h5 class="card-title text-center mb-4">สมัครสมาชิกสำเร็จ!</h5>
            <p class="text-center">ยินดีต้อนรับ, <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p class="text-center">คุณสมัครสมาชิกเรียบร้อยแล้ว</p>
            <a href="login.php" class="btn btn-primary btn-block">กลับไปยังหน้าเข้าสู่ระบบ</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body>
</html>
