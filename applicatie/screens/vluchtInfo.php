<?php
require_once '../starting/db_connectie.php';

// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();

require_once '../querys/vluchtenInfoQuery.php';
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
    <br>
    <section class="vluchtpagina">
        <img src="../images/vliegtuig.png"/>
        <section class="film_beschrijving">
        <?php 
        echo $vluchtenLijst; 
            ?>
            
        </section>

    </section>

</div>
    </div>
</body>
<?php include "../components/footer.php" ?>
</html>