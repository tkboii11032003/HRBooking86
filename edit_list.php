<?php
session_start();
require_once "connection.php";

// ตรวจสอบว่ามีการส่งคำขอแก้ไขข้อมูลผู้ใช้หรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ดึงข้อมูลผู้ใช้ตาม ID
    $query = "SELECT * FROM user WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $query);
    $username = mysqli_fetch_assoc($result);
}

// บันทึกการแก้ไขข้อมูลผู้ใช้
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    // อัปเดตข้อมูลผู้ใช้ในฐานข้อมูล
    $passwordenc = md5($password); // Assuming you want to hash the password
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
        $_SESSION['success'] = "ข้อมูลผู้ใช้ถูกอัปเดตสำเร็จ";
        header("Location: indexlogin.php");
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปเดตข้อมูล";
        header("Location: edit_user.php?id=$id");
        exit;
    }
}

// รับค่าการค้นหาจากฟอร์ม ถ้ามี
$search = isset($_GET['search']) ? $_GET['search'] : '';

// คิวรี่ข้อมูลจากตาราง user โดยมีการตรวจสอบการค้นหา
$queryproduct = $conn->prepare("SELECT * FROM user WHERE username LIKE ?");
$queryproduct->bind_param("s", $searchTerm);
$searchTerm = "%$search%";
$queryproduct->execute();
$rsproduct = $queryproduct->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2>แก้ไขข้อมูลส่วนตัวของผู้ใช้</h2>

    <!-- แสดงข้อความสำเร็จหรือข้อผิดพลาด -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($username)): ?>
        <div class="card mt-5">
            <div class="card-header">
                Edit User
            </div>
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $id; ?>" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username['username']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password" required>
                    </div>
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($username['firstname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($username['lastname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nickname">Nickname</label>
                        <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo htmlspecialchars($username['nickname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($username['email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo htmlspecialchars($username['mobile']); ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-submit">Save Changes</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <h3>รายชื่อของสมาชิกทั้งหมด</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>รายชื่อ Username</th>
                    <th>รายละเอียดที่ต้องการแก้ไข</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($rsproduct) > 0): ?>
                    <?php foreach ($rsproduct as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['username']); ?></td>
                            <td>
                                <a href="edit_list.php?id=<?= $row['id']; ?>" class="btn btn-warning">แก้ไขข้อมูล</a>
                                <a href="delete_user.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?');">ลบข้อมูล</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">ไม่พบข้อมูล</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
