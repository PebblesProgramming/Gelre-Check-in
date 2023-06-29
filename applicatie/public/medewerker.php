<?php
require_once '../db_connectie.php';
require_once '../data/check-aantalEnGewicht.php';
// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelre-Check-In</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> <!--custom font, might change later-->
</head>
<body>
    <div class="container">
        <?php include "../public/navbar.php" ?>
        <div class="row">
            <div class="col-1">
                <h2> Gelre Check In</h2>
                <h3> Help met dit dashboard passagiers goed op weg</h3>
                <a href="../screens/vluchten.php"><button type="button">Vluchten</button></a>
            </div>
            <div class="col-2">
                <img src="../images/checkin.png" class="checkin">
                <div class="color-box"></div>
                <div class="add-btn">     
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="item">
         <h1>Zoek een passagier!</h1> 
         <br>
         <form action="boekingen.php" method="get">
            <input type="text" name="passagiernummer" placeholder="Passagiernummer" required>
            <button type="submit">Verzenden</button>
        </form>
</div>
<div class="item">
    <h1> Actie vereist</h1>
    <br>
    <?php
    if (isset($_SESSION['rol'])) {
            $rol = $_SESSION['rol'];
            if($rol == 'medewerker'){
            checkVluchtenEisen($db);
            } else{
                echo' <h2> Neem een kijkje naar alle vluchten! </h2><br>';
            }
          }
  ?>
    </div>
</body>

</html>
