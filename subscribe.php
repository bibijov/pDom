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
    <title>Subscribe</title>
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
    <header>
        <div class="container">
            <section id="branding">
                <h1><span class="highlight">BBIT</span></h1>
            </section>
            <nav>
                <ul>
                    <li class="curent"><a href="landing.php">Pocetna</a></li>
                    <li><a href="about.php">O nama</a></li>
                    <li>
                        <a href="#">Blog</a>
                </li>
                <li><a href="contact.php">Kontakt</a></li>
                <li><a href="subscribe.php">Subscribe</a></li>
                <li><a href="search.php">Pretraga</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="info">
        <h1>Ovde se možete prijaviti da dobijate naše ponude putem email-a.</h1>
    </div>
    <div class="formaKontejner">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" id="subscribe-tab" data-bs-toggle="tab" href="#subscribe">Subscribe</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="unsubscribe-tab" data-bs-toggle="tab" href="#unsubscribe">Unsubscribe</a>
      </li>
    </ul>

    <div class="tab-content mt-2">
      <div class="tab-pane fade show active" id="subscribe">
        <h4>Subscribe</h4>
        <form action="subscribe.php" method="post" autocomplete="off">
          
          <div class="form-group">
            <label for="subscribe-email">Email</label>
            <input type="email" class="form-control" name="email" id="subscribe-email" placeholder="Enter email">
          </div>
       
          <button type="submit" class="btn btn-primary" name="subscribe">Subscribe</button>
        </form>
      </div>

      <div class="tab-pane fade" id="unsubscribe">
        <h4>Unsubscribe</h4>
        <form action="subscribe.php" method="post" autocomplete="off">
          <div class="form-group">
            <label for="unsubscribe-email">Email</label>
            <input type="email" class="form-control" name="email" id="unsubscribe-email" placeholder="Unesite email">
          </div>
          <button type="submit" class="btn btn-primary" name="unsubscribe">Unsubscribe</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>