<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>
    <div class="form">
        <h1>Error</h1>
        <p>
            <?php
            if(isset($_SESSION['message']) AND !empty($_SESSION['message'])):
                echo $_SESSION['message'];
            else:
                header("location: index.php");
            endif;
            ?>
        </p>
        <a href="index.php"><button class="button button-block">Pocetna</button></a>
    </div>
</body>
</html>