<?php
// เริ่มต้นเซสชัน
session_start();

// ตั้งค่าการเชื่อมต่อกับฐานข้อมูล
$servername = "localhost";  
$db_username = "root";       
$db_password = "";           
$dbname = "login_system";    

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// ตัวแปรสำหรับข้อความผิดพลาด
$error = '';

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
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['username'] = $user['username']; 
            header("Location: profile.php");
            exit();
        } else {
            $error = "รหัสผ่านไม่ถูกต้อง";
        }
    } else {
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
    <title>เข้าสู่ระบบ</title>
    <script>
        function showError(message) {
            alert(message);
        }

        window.onload = function() {
            var error = "<?php echo addslashes($error); ?>";
            if (error) {
                showError(error);
            }
        };
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Css/login.css">
</head>
<body>
  <section>
<span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> 

    <div class="signin">
      <div class="content">
        <h2>เข้าสู่ระบบ</h2>

        <?php if (isset($error)) : ?>
            <p class="text-danger text-center"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="login.php">
          <div class="form">
            <div class="inputBox">
              <input type="text" name="username" required>
              <i>ชื่อผู้ใช้</i>
            </div>

            <div class="inputBox">
              <input type="password" name="password" required>
              <i>รหัสผ่าน</i>
            </div>

            <div class="links">
              <a href="#">ยังไม่มีรหัสผ่าน?</a>
              <a href="register.php">สมัครสมาชิก</a>
            </div>

            <div class="inputBox">
              <input type="submit" value="เข้าสู่ระบบ">
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

</body>
</html>