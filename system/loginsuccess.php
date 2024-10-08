<?php
session_start();

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}
?>


























<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/success.css">
    <title>ล็อกอินสำเร็จ</title>
</head>
<body>
    <div class="success-container">
        <h2>ล็อกอินสำเร็จ!</h2>
        <p>ยินดีต้อนรับ, คุณล็อกอินสำเร็จแล้ว</p>
        <a href="logout.php">ออกจากระบบ</a>
    </div>
</body>
</html>

