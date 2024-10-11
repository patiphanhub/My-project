<?php
session_start();
session_unset();  // ลบข้อมูลในเซสชันทั้งหมด
session_destroy();  // ทำลายเซสชัน

// เปลี่ยนหน้ากลับไปที่หน้า login
header("Location: login.php");
exit();
?>
