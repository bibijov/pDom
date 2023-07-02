<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>success</title>
</head>
<body>
    <div class="form">
    <h1><?php echo 'Success'; ?></h1>
        <p>
            <?php
            if(isset($_SESSION['message']) && !empty($_SESSION['message'])) {
                echo $_SESSION['message'];
            } else {
                header("location: index.php");
                exit(); // Dodajemo exit() da se zaustavi daljnje izvršavanje koda
            }
            ?>
        </p>
        <a href="index.php"><button class="button button-block">Pocetna</button></a>
    </div>
</body>
</html>