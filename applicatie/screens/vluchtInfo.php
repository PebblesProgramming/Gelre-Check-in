<?php
require_once '../querys/vluchtinfoquery.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vluchten</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/vluchten.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> <!--custom font, might change later-->
</head>
<body>
    <div class="container">
    <?php include "../components/navbar.php" ?>
 
    <h1> Vlucht </h1>
            <br>
    <section class="filmpagina">
        <?php
        // replace with my own variable 
        //echo $filmInfo; ?>
        <img src="../images/vliegtuig.png"/>
        <section class="film_beschrijving">
            <h2>Jaar: </h2>
            <br>
            <h2>Duur:</h2>
            <br>
            <h2>Regisseur: /h2>
            <br>
            <h2>Hoofdrolspelers:  <?php    ?></h2>
            <br>
            <h2>Samenvatting:</h2>
            <br>
            <p>
            </p>
            <h2>Vorige deel:  </h2>
            <br>
            <!-- <a href="https://youtu.be/Ba0fm-6q6QQ"><h2>Trailer Link</h2></a> -->
            <button>Boek</button><a href="#"></a>
        </section>

    </section>

</div>
    </div>
</body>
<?php include "../components/footer.php" ?>
</html>