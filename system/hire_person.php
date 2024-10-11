<?php
session_start();
// ข้อมูลจำลองสำหรับบุคคล (เชื่อมต่อฐานข้อมูลจริงได้)
$persons = [
    1 => [
        "name" => "สมชาย ใจดี",
        "address" => "123/45 ถนนสุขสบาย แขวงบางนา เขตบางนา กรุงเทพฯ 10260",
        "phone" => "080-123-4567",
        "image" => "images/person1.jpg"
    ],
    2 => [
        "name" => "สมหญิง ประหยัดทรัพย์",
        "address" => "789/99 ซอยสบายใจ แขวงลาดพร้าว เขตลาดพร้าว กรุงเทพฯ 10310",
        "phone" => "081-987-6543",
        "image" => "images/person2.jpg"
    ],
    3 => [
        "name" => "สมปอง รวยทรัพย์",
        "address" => "456/78 หมู่บ้านหรู แขวงพญาไท เขตพญาไท กรุงเทพฯ 10400",
        "phone" => "082-456-7890",
        "image" => "images/person3.jpg"
    ]
];

// รับค่า ID จาก POST ที่ส่งมาจากฟอร์ม
$person_id = isset($_POST['person_id']) ? (int)$_POST['person_id'] : 0;

if (!isset($persons[$person_id])) {
    echo "ไม่พบข้อมูลบุคคลที่ต้องการจ้าง";
    exit;
}

$person = $persons[$person_id];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยืนยันการจ้างบุคคล - <?php echo htmlspecialchars($person['name']); ?></title>
    <link rel="stylesheet" href="../Css/hire_person.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <h1>ยืนยันการจ้างบุคคล</h1>
        <div class="person-confirm">
            <img src="<?php echo htmlspecialchars($person['image']); ?>" alt="<?php echo htmlspecialchars($person['name']); ?>">
            <div class="person-info">
                <p><strong>ชื่อ:</strong> <?php echo htmlspecialchars($person['name']); ?></p>
                <p><strong>ที่อยู่:</strong> <?php echo htmlspecialchars($person['address']); ?></p>
                <p><strong>เบอร์โทรศัพท์:</strong> <?php echo htmlspecialchars($person['phone']); ?></p>

                <button class="btn-confirm" onclick="confirmHire(<?php echo $person_id; ?>)">ยืนยันการจ้าง</button>
                <a href="person.php" class="btn-cancel">ยกเลิก</a>
            </div>
        </div>
    </div>

    <script>
    function confirmHire(personId) {
        Swal.fire({
            title: 'ยืนยันการจ้าง?',
            text: "คุณต้องการยืนยันการจ้างบุคคลนี้หรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                // ส่งค่าไปยัง hire_complete.php ด้วย form ที่สร้างขึ้นอัตโนมัติ
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'hire_complete.php';

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'person_id';
                input.value = personId;
                
                form.appendChild(input);
                document.body.appendChild(form);

                form.submit(); // ส่งฟอร์มเพื่อเปลี่ยนหน้า
            }
        })
    }
    </script>
</body>
</html>
