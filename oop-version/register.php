<?php 
    session_start();
    require_once('config.php');

    $dataObj = new System();

    if (isset($_POST['signup'])) {
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $c_password = $_POST['c_password'];
      $result = $dataObj->registerUser($firstname, $lastname, $email, $password, $c_password);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <style>
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
        }

        .form-signin .checkbox {
        font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
        z-index: 2;
        }

    </style>    
</head>
<body>

    <?php 
        require_once("nav.php");
    ?>
    <main class="form-signin">
  <form method="POST">
    <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            ?>
        </div>
    <?php } ?>

    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success" role="alert">
            <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            ?>
        </div>
    <?php } ?>

    <?php if (isset($_SESSION['warning'])) { ?>
        <div class="alert alert-warning" role="alert">
            <?php 
                echo $_SESSION['warning'];
                unset($_SESSION['warning']);
            ?>
        </div>
    <?php } ?>

    <div class="form-floating">
      <input type="text" class="form-control" name="firstname" placeholder="Enter your firstname">
      <label for="firstname">Firstname</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="lastname" placeholder="Enter your lastname">
      <label for="lastname">Lastname</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" name="email" placeholder="name@example.com">
      <label for="email">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" placeholder="Enter your Password">
      <label for="password">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="c_password" placeholder="Enter your Confirm Password">
      <label for="confirm password">Confirm Password</label>
    </div>
    
    <button class="w-100 btn btn-lg btn-primary" name="signup" type="submit">Sign Up</button>
  </form>
</main>

  <?php 
    require_once("footer.php");
  ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
</body>
</html>