<?php
session_start();
require_once "connection.php";

// ตรวจสอบว่ามีการส่งค่า ID มาใน URL หรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // เตรียมและรันคำสั่ง SQL เพื่อลบข้อมูล
    $query = "DELETE FROM user WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "ลบข้อมูลผู้ใช้สำเร็จ";
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการลบข้อมูล";
    }

    // เปลี่ยนเส้นทางกลับไปที่หน้า edit_list.php
    header("Location: edit_list.php");
    exit;
} else {
    // หากไม่มี ID ส่งมาด้วย ให้เปลี่ยนเส้นทางกลับไปที่หน้า edit_list.php
    header("Location: edit_list.php");
    exit;
}
