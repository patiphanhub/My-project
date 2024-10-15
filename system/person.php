<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อบุคคล</title>
    <link rel="stylesheet" href="../Css/person.css">
</head>
<body>
    <div class="container">
        <h1>รายชื่อบุคคล</h1>
        <div class="person-list">
            <!-- ข้อมูลบุคคลที่กรอกเอง -->
            <a href="person_detail.php?id=1" class="person-card-link"> <!-- ใช้ลิงก์ครอบทั้งบัตร -->
                <div class="person-card">
                    <img src="../images/YamLap.jpg" alt="บุคคล 1">
                    <div class="person-info">
                        <h2>สมชาย ใจดี</h2>
                        <p><strong>ที่อยู่:</strong><br>
                            123/45 ถนนสุขสบาย<br>
                            แขวงบางนา เขตบางนา<br>
                            กรุงเทพฯ 10260
                        </p>
                        <p><strong>เบอร์โทรศัพท์:</strong> 080-123-4567</p>
                    </div>
                </div>
            </a>

            <a href="person_detail.php?id=2" class="person-card-link">
                <div class="person-card">
                    <img src="../images/YamNgao.jpg" alt="บุคคล 2">
                    <div class="person-info">
                        <h2>สมหญิง ประหยัดทรัพย์</h2>
                        <p><strong>ที่อยู่:</strong><br>
                            789/99 ซอยสบายใจ<br>
                            แขวงลาดพร้าว เขตลาดพร้าว<br>
                            กรุงเทพฯ 10310
                        </p>
                        <p><strong>เบอร์โทรศัพท์:</strong> 081-987-6543</p>
                    </div>
                </div>
            </a>

            <a href="person_detail.php?id=3" class="person-card-link">
                <div class="person-card">
                    <img src="../images/YamKhriat.jpg" alt="บุคคล 3">
                    <div class="person-info">
                        <h2>สมปอง รวยทรัพย์</h2>
                        <p><strong>ที่อยู่:</strong><br>
                            456/78 หมู่บ้านหรู<br>
                            แขวงพญาไท เขตพญาไท<br>
                            กรุงเทพฯ 10400
                        </p>
                        <p><strong>เบอร์โทรศัพท์:</strong> 082-456-7890</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</body>
</html>
