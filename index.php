<?php
require 'db.php';
require 'class.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up/Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    
        <link rel="stylesheet" href="style.css">

</head>
<?php
    $object1 = new UserInterface();

    if($_SERVER['REQUEST_METHOD']== 'POST')
    {
        if(isset($_POST['login'])){
            $object1->login();
        }
        elseif(isset($_POST['register'])){
            $object1->register();
        }
        elseif(isset($_POST['subscribe'])){
            $object1->subscribe();
        }
        elseif(isset($_POST['unsubscribe'])){
            $object1->unsubscribe();
        }
    }
?>
<body>
<div class="formaKontejner">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" id="login-tab" data-bs-toggle="tab" href="#login">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="signup-tab" data-bs-toggle="tab" href="#signup">Signup</a>
      </li>
    </ul>

    <div class="tab-content mt-2">
      <div class="tab-pane fade show active" id="login">
        <h4>Login</h4>
        <form action="index.php" method="post" autocomplete="off">
          <div class="form-group">
            <label for="login-email">Email</label>
            <input type="email" class="form-control" name="email" id="login-email" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="login-password">Password</label>
            <input type="password" class="form-control" name="password" id="login-password" placeholder="Enter password">
          </div>
          <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
      </div>

      <div class="tab-pane fade" id="signup">
        <h4>Registracija</h4>
        <form action="index.php" method="post" autocomplete="off">

            <div class="form-group">
                <label for="signup-name">Ime</label>
                <input type="text" class="form-control"  name="ime" id="signup-name" placeholder="Unesite Vase ime">
            </div>
            <div class="form-group">
                <label for="signup-lastname">Prezime</label>
                <input type="text" class="form-control" name="prezime" id="signup-lastname" placeholder="Unesite Vase Prezime">
            </div>
          <div class="form-group">
            <label for="signup-email">Email</label>
            <input type="email" class="form-control" name="email" id="signup-email" placeholder="Unesite email">
          </div>
          <div class="form-group">
            <label for="signup-password">Password</label>
            <input type="password" class="form-control" name="password" id="signup-password" placeholder="Unesite password">
          </div>
          <button type="submit" class="btn btn-primary" name="register">Registracija</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>