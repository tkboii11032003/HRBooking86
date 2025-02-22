<?php 
session_start();
require_once "connection.php";

// ตรวจสอบว่ามีการส่งคำขอแก้ไขข้อมูลผู้ใช้หรือไม่
if (isset($_GET['id']) && intval($_GET['id']) > 0) {
    $id = intval($_GET['id']); // แปลงค่า id เป็น integer เพื่อป้องกัน SQL Injection

    // ดึงข้อมูลผู้ใช้ตาม ID
    $query = "SELECT * FROM user WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "<p style='color:red;'>User not found or invalid ID.</p>";
        echo '<a href="index.php" class="btn btn-secondary btn-back">Go back to index</a>';
        $user = null; // ตั้งค่าเป็น null เพื่อป้องกันข้อผิดพลาด
    }
} else {
    echo "<p style='color:red;'>No ID provided. Please go back and select a user to edit.</p>";
    echo '<a href="index.php" class="btn btn-secondary btn-back">Go back to index</a>';
    exit; // หยุดการทำงานของสคริปต์
}
?>


// บันทึกการแก้ไขข้อมูล
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    $passwordenc = md5($password); // NOTE: ควรพิจารณาใช้ password_hash() เพื่อความปลอดภัย

    // อัปเดตข้อมูลผู้ใช้ในฐานข้อมูล
    $query = "UPDATE user SET 
              username = '$username', 
              password = '$passwordenc', 
              firstname = '$firstname', 
              lastname = '$lastname', 
              nickname = '$nickname', 
              email = '$email', 
              mobile = '$mobile' 
              WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['success'] = "User information updated successfully";
        header("Location: indexlogin.php");
        exit;
    } else {
        $_SESSION['error'] = "Something went wrong";
        header("Location: edit_user.php?id=$id");
        exit;
    }
}
?>
