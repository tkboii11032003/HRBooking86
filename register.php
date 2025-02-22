<?php 
    session_start();

    require_once "connection.php";

    if (isset($_POST['submit'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $nickname = $_POST['nickname'];
        // $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        


        // Check if username already exists
        $user_check = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $user_check);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            echo "<script>alert('Username already exists');</script>";
        } else {
            $passwordenc = md5($password); // NOTE: Consider using more secure hashing methods like password_hash()

            // Insert new user into database
            $query = "INSERT INTO user (username, password, firstname, lastname, nickname, email, mobile, userlevel)
                        VALUES ('$username', '$passwordenc', '$firstname', '$lastname', '$nickname', '$email', '$mobile', 'm')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $_SESSION['success'] = "User registered successfully";
                header("Location: indexlogin.php");
                exit;
            } else {
                $_SESSION['error'] = "Something went wrong";
                header("Location: index.php");
                exit;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
       body {
           background-image: url('/HRBooking86/web/assets/img/portfolio/TEST.jpg'); /* กำหนดที่อยู่ของรูปภาพ */
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
            max-width: 550px; /* ปรับความกว้าง */
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
            background-color: #000000; /* Blue color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #000000; /*สีเวลากดsubmit */
        }

        .btn-back {
            margin-top: 10px;
            text-align: center;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #000000;
            color: red;
        }
    </style>
</head>
<body>

    <div class="card">
        <h2 class="text-center mb-4">REGISTER</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="กรุณากรอกชื่อผู้ใช้" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="กรุณากรอกรหัสผ่าน" required>
            </div>
            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="กรุณากรอกชื่อจริง" required>
            </div>
            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="กรุณากรอกนามสกุล" required>
            </div>
            <div class="form-group">
                <label for="nickname">Nickname</label>   
                <input type="text" class="form-control" id="nickname" name="nickname" placeholder="กรุณากรอกชื่อเล่น" required>
            </div>
          
            <div class="form-group">
                <label for="mobile">Mobile number</label>   
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="กรุณากรอกหมายเลขโทรศัพท์" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-submit">REGISTER</button>
        </form>
        
        <a href="indexlogin.php" class="btn btn-secondary btn-back">BACK</a>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>