<!DOCTYPE html>

<?php

//Controleer of de medewerker is ingelogd, anders doorsturen naar de inlogpagina
// session_start();
// if (!isset($_SESSION['ingelogd']) || $_SESSION['ingelogd'] !== true) {
//     header('Location: ../index.php'); // let op dat de links kloppen het is soms erg verwarrend
//     exit;
// }

require_once '../starting/db_connectie.php';

// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();


// Debug
//echo 'Welkom, medewerker!';

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
         <h1 class="h1flights">Recente Vluchten</h1> 
    
        <div class="wrapper">
            <?php 

            // Ik doe dit zo met de count omdat de LIMIT niet werkt
         $vluchtQuery = 'SELECT vluchtnummer, bestemming, vertrektijd 
                FROM Vlucht
                ORDER BY vertrektijd DESC';

                $data = $db->query($vluchtQuery);
                $count = 0;
                $maxItems = 12;

                while ($rij = $data->fetch()) {
                if ($count >= $maxItems) {
                    break;
                }

                $vluchtnummer = $rij['vluchtnummer'];
                $bestemming = $rij['bestemming'];
                $vertrektijd = $rij['vertrektijd'];

                echo '<a href="../screens/vluchtinfo.php?id=' . $vluchtnummer . '">';
                echo '<div class="item">';
                echo $vluchtnummer . '<br>';
                echo $bestemming;
                echo '</div>';
                echo '</a>';

                $count++;
}

?>
        </div>
        
    </div>
</body>

</html>
