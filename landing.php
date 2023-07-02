<?php
$connect=mysqli_connect('127.0.0.1:3307', 'root', '', 'pdom');
$query= "SELECT * FROM korisnici ORDER BY ime DESC";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pocetna</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</head>
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
    <div class="main">
        <div class="landingImg">
            </div>
        <h1 class="dobrd">Dobrodošli na BBIT</h1>

        <div class="marketing">
            <div class="markBox">
                <h1>Misija</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a nibh est. Praesent in mollis nibh. Aenean libero leo, pharetra nec sodales et, posuere sed augue.</p>
            </div>
            <div class="markBox">
                <h1>Vizija</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a nibh est. Praesent in mollis nibh. Aenean libero leo, pharetra nec sodales et, posuere sed augue.</p>
            </div>
            <div class="markBox">
                <h1>Ciljevi</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a nibh est. Praesent in mollis nibh. Aenean libero leo, pharetra nec sodales et, posuere sed augue.</p>
            </div>
        </div>
        <div class="container" style="width:700px; margin-top:50px;" >
        <div class="table-resposive" id="tabela_korisnici">
            <table class="table table-bordered">
                <tr>
                    <th><a href="#" class="column_sort" id="ime" data-order="desc">Ime</a></th>
                    <th><a href="#" class="column_sort" id="prezime" data-order="desc">Prezime</a></th>
                    <th><a href="#" class="column_sort" id="email" data-order="desc">Email</a></th>

                </tr>
                <?php
                while($row=mysqli_fetch_array($result))
                {
                    ?>
                    <tr>
                        <td><?php echo $row["ime"]; ?></td>
                        <td><?php echo $row["prezime"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>

                    </tr>
                    <?php
                    }
                    ?>
            </table>
            </div>
        </div>
    </div>

    <footer>
        <p>BBIT, copyright &copy; 2023</p>
    </footer>
</body>
</html>

<script>
    $(document).ready(function(){
        $(document).on('click', '.column_sort', function(){
            var column_name=$(this).attr("id");
            var order = $(this).data("order");
            var arrow='';
            if(order=='desc')
            {
                arrow='&nbsp;<i class="bi bi-arrow-down"></i>';
            }
            else{
                arrow='&nbsp;<i class="bi bi-arrow-up"></i>';

            }
            $.ajax({
                url:"query.php",
                method:"POST",
                data:{column_name:column_name, order:order},
                success:function(data){
                    $(tabela_korisnici).html(data);
                    $('#'+column_name+'').append(arrow);
                }
            })
        });
    });
</script>