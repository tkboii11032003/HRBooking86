<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login ADMIN</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
        body {
           background-image: url('/HRBooking86/web/assets/img/portfolio/TEST.jpg'); 
           background-size: cover; 
           background-position: center; 
           background-repeat: no-repeat; 
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
            max-width: 650px; 
            padding: 40px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            background-color: #ffffff; 
            color: #333333; 
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
            background-color: #000000; 
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #000000; 
        }

        .btn-back {
            margin-top: 30px; /* เพิ่ม margin-top ให้ปุ่มย้อนกลับ */
            width: 100%; 
            padding: 10px;
            background-color: #000000;
            border-radius: 5px;
            color: #ffffff;
            font-weight: bold;
            transition: background-color 0.3s ease;
            text-align: center;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #000000;
            color: white;
        }

        /* เพิ่มการจัดวางปุ่มย้อนกลับให้อยู่ใต้ปุ่ม Login อย่างพอดี */
        .form-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

    </style>
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

            <div class="text-center">
    <img src="assets/LOGOindexlogin/logo2.jpg" alt="LOGO" class="logo">
            </div>

            <h2 class="text-center mb-4">LOGIN ADMIN/HR</h2> 

            <form action="admin_login.php" method="post"> 
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="กรุณากรอกชื่อผู้ใช้" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="กรุณากรอกรหัสผ่าน" required>
                </div>
                <div class="form-buttons">
                    <button type="submit" name="submit" class="btn btn-primary btn-submit">LOGIN</button>
                    <!-- ปุ่มย้อนกลับ -->
                    <a href="indexlogin.php" class="btn-back">BACK</a> 
                </div>
            </form>
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
