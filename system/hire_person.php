<?php
session_start();

// ข้อมูลจำลองสำหรับบุคคล (เชื่อมต่อฐานข้อมูลจริงได้)
$persons = [
    1 => [
        "name" => "สมชาย ใจดี",
        "address" => "123/45 ถนนสุขสบาย แขวงบางนา เขตบางนา กรุงเทพฯ 10260",
        "phone" => "080-123-4567",
        "image" => "images/Yamlap.jpg"
    ],
    2 => [
        "name" => "สมหญิง ประหยัดทรัพย์",
        "address" => "789/99 ซอยสบายใจ แขวงลาดพร้าว เขตลาดพร้าว กรุงเทพฯ 10310",
        "phone" => "081-987-6543",
        "image" => "images/YamNgao.jpg"
    ],
    3 => [
        "name" => "สมปอง รวยทรัพย์",
        "address" => "456/78 หมู่บ้านหรู แขวงพญาไท เขตพญาไท กรุงเทพฯ 10400",
        "phone" => "082-456-7890",
        "image" => "images/YamKhriat.jpg"
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
    <link rel="stylesheet" href="../Css/confirm_hiring.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <h1>ยืนยันการจ้างบุคคล</h1>
        <div class="person-confirm">
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
            // แสดงกล่องข้อความ PayPal
            Swal.fire({
                title: 'ชำระเงินผ่าน PayPal',
                html: `<form id="paypal-form" action="hire_history.php" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick" />
                    <input type="hidden" name="hosted_button_id" value="5DZAK6MVFSV3Y" />
                    <input type="hidden" name="currency_code" value="THB" />
                    <input type="hidden" name="return" value="http://yourwebsite.com/hire_history.php" /> <!-- URL ที่ต้องการให้ผู้ใช้กลับไป -->
                    <input type="hidden" name="cancel_return" value="http://yourwebsite.com/cancel.php" /> <!-- URL สำหรับยกเลิก -->
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - ชำระเงินออนไลน์ได้ปลอดภัยกว่าและง่ายกว่า" alt="ซื้อทันที" />
                </form>`,
                showCancelButton: false,
                showConfirmButton: false,
                onOpen: () => {
                    // ส่งฟอร์ม PayPal เมื่อกล่องข้อความเปิด
                    document.getElementById('paypal-form').submit();
                }
            });
        }
    });
}

    </script>
</body>
</html>
