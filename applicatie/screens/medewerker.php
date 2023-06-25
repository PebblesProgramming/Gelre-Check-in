<!DOCTYPE html>

<?php

require_once '../starting/db_connectie.php';
// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();

?>

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
        <?php include "../components/navbar.php" ?>
        <div class="row">
            <div class="col-1">
                <h2> Gelre Check In</h2>
                <h3> Help met dit dashboard passagiers goed op weg</h3>
               
                <a href="../screens/vluchten.php"><button type="button">Vluchten</button></a>
            </div>
            <div class="col-2">
                <img src="../images/checkin.png" class="checkin">
                <div class="color-box"></div> <!-- Awesome background effect, look for better photo -->
                <div class="add-btn"> <!-- try and find an awesome implimintation for this -->      
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
        
    </div>
</body>

</html>
