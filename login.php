<?php 

session_start();

if (isset($_POST['username'])) {

    include('connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordenc = md5($password); // เข้ารหัสรหัสผ่านด้วย MD5

    // สร้างคำสั่ง SQL เพื่อตรวจสอบข้อมูลผู้ใช้
    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$passwordenc'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_array($result);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user'] = $row['firstname'] . " " . $row['lastname'];
        $_SESSION['userlevel'] = $row['userlevel'];

        // ตรวจสอบ userlevel และเปลี่ยนเส้นทางตามระดับผู้ใช้
        if ($_SESSION['userlevel'] == 'm') {
            header("Location: /HRBooking86/web/member/index.php");
            exit(); // เพิ่ม exit() เพื่อหยุดการทำงานของสคริปต์หลังจากเปลี่ยนเส้นทาง
        } else {
            // หาก userlevel ไม่ใช่ 'm' ให้แสดงข้อผิดพลาด
            $_SESSION['error'] = 'รหัสไม่ถูกต้อง กรุณาล็อกอินใหม่อีกครั้ง.';
            header("Location: indexlogin.php");
            exit(); // เพิ่ม exit() เพื่อหยุดการทำงานของสคริปต์หลังจากเปลี่ยนเส้นทาง
        }
    } else {
        // กรณีที่ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง
        $_SESSION['error'] = 'รหัสไม่ถูกต้อง กรุณาล็อกอินใหม่อีกครั้ง.';
        header("Location: indexlogin.php");
        exit(); // เพิ่ม exit() เพื่อหยุดการทำงานของสคริปต์หลังจากเปลี่ยนเส้นทาง
    }

} else {
    header("Location: index.php");
    exit(); // เพิ่ม exit() เพื่อหยุดการทำงานของสคริปต์หลังจากเปลี่ยนเส้นทาง
}

?>
