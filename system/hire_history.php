<?php
session_start();

// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// ตรวจสอบการกลับมาจาก PayPal
/*if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับข้อมูลที่ส่งมาจาก PayPal
    $payment_status = $_POST['payment_status'];
    $username = $_SESSION['username']; // หรือข้อมูลที่คุณเก็บไว้
    $full_name = $_POST['item_name']; // สมมติว่าคุณมีข้อมูลชื่อที่ส่งมาจาก PayPal
    $hire_date = date('Y-m-d H:i:s');

    if ($payment_status == "Completed") {
        // บันทึกประวัติการจ้างในฐานข้อมูล
        $stmt = $conn->prepare("INSERT INTO hire_history (user_id, full_name, hire_date) VALUES ((SELECT id FROM users WHERE username=?), ?, ?)");
        $stmt->bind_param("sss", $username, $full_name, $hire_date);
        
        if ($stmt->execute()) {
            echo "บันทึกประวัติการจ้างสำเร็จ";
        } else {
            echo "เกิดข้อผิดพลาด: " . $stmt->error;
        }
        $stmt->close();
    }
}*/

// ดึงข้อมูลประวัติการจ้างจากฐานข้อมูล พร้อมกับเส้นทางรูปภาพ
$sql = "SELECT users.username, hire_history.full_name, hire_history.hire_date, users.image
        FROM hire_history
        JOIN users ON hire_history.user_id = users.id
        ORDER BY hire_history.hire_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการจ้างทั้งหมด</title>
    <link rel="stylesheet" href="../Css/hire_history.css">
</head>
<body>
    <div class="container">
        <h1>ประวัติการจ้างทั้งหมด</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ผู้ใช้</th>
                        <th>ชื่อผู้ถูกจ้าง</th>
                        <th>วันที่จ้าง</th>
                        <th>รูปภาพ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['hire_date']); ?></td>
                            <td>
                                <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['full_name']); ?>" style="width: 50px; height: auto;">
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>ยังไม่มีประวัติการจ้าง</p>
        <?php endif; ?>
        <br>
        <a href="person.php" class="btn">กลับไปหน้าเลือกบุคคล</a>
        <a href="logout.php" class="btn">ออกจากระบบ</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
