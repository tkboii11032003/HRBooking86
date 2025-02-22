<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>86 FILMS</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
        body {
           background-image: url('/hr/web/assets/img/portfolio/TEST.jpg'); /* กำหนดที่อยู่ของรูปภาพ */
           background-size: cover; /* ทำให้รูปภาพครอบคลุมทั้งหน้าจอ */
           background-position: center; /* ทำให้รูปภาพอยู่ตรงกลาง */
           background-repeat: no-repeat; /* ป้องกันไม่ให้รูปภาพซ้ำ */
           display: flex;
           justify-content: center;
           align-items: center;
           height: 100vh;
           margin: 0;
           font-family: Roboto, sans-serif;
           color: #ffffff;
        }

        .card {
            width: 100%;
            max-width: 650px; /* ปรับความกว้าง */
            padding: 40px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            background-color: #ffffff; /* White background */
            color: #333333; /* สีข้อความ */
        }

        h2 {
            margin-bottom: 20px; 
            font-size: 28px; 
            font-weight: 600; 
            text-align: center; 
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
            background-color: #000000; /* สีปุ่มเข้าสู่ระบบ */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #000000; /* สีปุ่มเมื่อเลื่อนเมาส์ */
        }

        .btn-back {
            margin-top: 10px;
            text-align: center;
            display: inline-block;
            padding: 10px 20px;
            background-color: #cdb4db;
            border-radius: 5px;
            color: #ffffff;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #000000;
            color: white;
        }

        .btn-admin {
            width: 100%;
            padding: 10px;
            background-color: #000000; /* สีปุ่มแอดมิน */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-admin:hover {
            background-color: #333333; /* สีปุ่มเมื่อเลื่อนเมาส์ */
        }
    </style>
    <script>
        // ฟังก์ชันเพื่อเปลี่ยนเส้นทางเมื่อคลิกปุ่ม "Admin Login"
        function redirectToAdminLogin(event) {
            event.preventDefault(); // ป้องกันไม่ให้ฟอร์มถูกส่ง
            window.location.href = 'loginadmin.php'; // เปลี่ยนเส้นทางไปยังหน้า loginadmin.php
        }
    </script>
</head>
<body>

    <div class="card">
        <div class="container">
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success']; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; ?>
                </div>
            <?php endif; ?>
<!-- เพิ่มส่วนของโลโก้ -->
<div class="text-center">
    <img src="assets/LOGOindexlogin/logo2.jpg" alt="LOGO" class="logo">
            </div>



            <!-- <h2 class="text-center mb-4">86 FILMS</h2>  -->

            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="กรุณากรอกชื่อผู้ใช้" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="กรุณากรอกรหัสผ่าน" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-submit">LOGIN</button>
                <button type="button" class="btn btn-admin" onclick="redirectToAdminLogin(event)">ADMIN , HR LOGIN</button>
            </form>

            <a href="register.php" class="btn-back btn-primary">REGISTER</a>
        </div>
    </div>

    <style>
        .logo {
    width: 150px; /* ปรับขนาดโลโก้ */
    height: auto;
    margin-bottom: 15px;
}

    </style>

</body>

</html>