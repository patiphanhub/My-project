<?php
// ข้อมูลจำลองสำหรับบุคคล (คุณสามารถเชื่อมต่อฐานข้อมูลได้)
$persons = [
    1 => [
        "name" => "สมชาย ใจดี",
        "address" => "123/45 ถนนสุขสบาย แขวงบางนา เขตบางนา กรุงเทพฯ 10260",
        "phone" => "080-123-4567",
        "image" => "../images/YamLap.jpg"
    ],
    2 => [
        "name" => "สมหญิง ประหยัดทรัพย์",
        "address" => "789/99 ซอยสบายใจ แขวงลาดพร้าว เขตลาดพร้าว กรุงเทพฯ 10310",
        "phone" => "081-987-6543",
        "image" => "../images/YamNgao.jpg"
    ],
    3 => [
        "name" => "สมปอง รวยทรัพย์",
        "address" => "456/78 หมู่บ้านหรู แขวงพญาไท เขตพญาไท กรุงเทพฯ 10400",
        "phone" => "082-456-7890",
        "image" => "../images/YamKhriat.jpg"
    ]
];

// รับค่า ID จาก URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!isset($persons[$id])) {
    echo "ไม่พบข้อมูลบุคคล";
    exit;
}

$person = $persons[$id];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดบุคคล - <?php echo htmlspecialchars($person['name']); ?></title>
    <link rel="stylesheet" href="../Css/person_detail.css">
</head>
<body>
    <div class="container">
        <h1>รายละเอียดของ <?php echo htmlspecialchars($person['name']); ?></h1>
        <div class="person-detail">
            <img src="<?php echo htmlspecialchars($person['image']); ?>" alt="<?php echo htmlspecialchars($person['name']); ?>">
            <div class="person-info">
                <p><strong>ชื่อ:</strong> <?php echo htmlspecialchars($person['name']); ?></p>
                <p><strong>ที่อยู่:</strong> <?php echo htmlspecialchars($person['address']); ?></p>
                <p><strong>เบอร์โทรศัพท์:</strong> <?php echo htmlspecialchars($person['phone']); ?></p>
                <div class="buttons">
                    <a href="person.php" class="btn-back">กลับไปยังรายชื่อบุคคล</a>
                    <form action="hire_person.php" method="post">
                        <input type="hidden" name="person_id" value="<?php echo $id; ?>">
                        <button type="submit" class="btn-hire">เลือกจ้าง</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
