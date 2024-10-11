<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link rel="stylesheet" href="../Css/register.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <h1>สมัครสมาชิก</h1>
            <?php
            session_start();
            // แสดงข้อความข้อผิดพลาดถ้ามี
            if (isset($_SESSION['error'])) {
                echo "<div style='color: red;'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']); // ลบข้อความออกหลังจากแสดงแล้ว
            }
            ?>
            <form id="signup-form" method="POST" action="signup.php">
                <div class="form-group">
                    <label for="id_card_number">เลขบัตรประชาชน:</label>
                    <input type="text" id="id_card_number" name="id_card_number" placeholder="กรุณากรอกเลขบัตรประชาชน" required>
                </div>
                <div class="form-group">
                    <label for="full-name">ชื่อ – นามสกุล:</label>
                    <input type="text" id="full-name" name="full_name" placeholder="กรุณากรอกชื่อ – นามสกุล" required>
                </div>
                <div class="form-group">
                    <label for="gender">เพศ:</label>
                    <select id="gender" name="gender" required>
                        <option value="male">ชาย</option>
                        <option value="female">หญิง</option>
                        <option value="other">อื่น ๆ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="age">อายุ:</label>
                    <input type="number" id="age" name="age" placeholder="กรุณากรอกอายุ" required>
                </div>
                <div class="form-group">
                    <label for="address">ที่อยู่:</label>
                    <input type="text" id="address" name="address" placeholder="กรุณากรอกที่อยู่" required>
                </div> 
                <div class="form-group">
                    <label for="province">จังหวัด:</label>
                    <input type="text" id="province" name="province" placeholder="กรุณากรอกจังหวัด" required>
                </div>
                <div class="form-group">
                    <label for="postal-code">รหัสไปรษณีย์:</label>
                    <input type="text" id="postal-code" name="postal_code" placeholder="กรุณากรอกรหัสไปรษณีย์" required>
                </div>
                <div class="form-group">
                    <label for="phone">เบอร์โทรศัพท์:</label>
                    <input type="tel" id="phone" name="phone" placeholder="กรุณากรอกเบอร์โทรศัพท์" required>
                </div>
                <div class="form-group">
                    <label for="email">อีเมลล์:</label>
                    <input type="email" id="email" name="email" placeholder="กรุณากรอกอีเมลล์" required>
                </div>
                <div class="form-group">
                    <label for="username">ผู้ใช้งาน:</label>
                    <input type="text" id="username" name="username" placeholder="กรุณากรอกผู้ใช้งาน" required>
                </div>
                <div class="form-group">
                    <label for="password">รหัสผ่าน:</label>
                    <input type="password" id="password" name="password" placeholder="กรุณากรอกรหัสผ่าน" required>
                </div>
                <button type="submit" class="btn-submit">สมัครสมาชิก</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <?php if (isset($_SESSION['success'])): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'สมัครสมาชิกสำเร็จ',
                text: 'คุณสามารถเข้าสู่ระบบได้แล้ว',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login.php'; // เปลี่ยนเส้นทางไปหน้า login.php
                }
            });
        </script>
        <?php unset($_SESSION['success']); // ลบข้อความ success ?>
    <?php endif; ?>
</body>
</html>
