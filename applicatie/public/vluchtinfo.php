<?php

require_once '../db_connectie.php';
require_once '../app/vluchtInfo_functie.php';
require_once '../app/filterInput_functie.php';
// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vluchten</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/vluchtenpagina.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> <!--custom font, might change later-->
</head>
<body>
    <div class="container">
<?php include "../public/navbar.php" ?>
    <div class="container2">

       <div class="item">
        <?php 
                //ZOEKOPDRACHT
                if (isset($_GET['vluchtnummer'])) {
                    $vluchtnummer = filterInput($_GET['vluchtnummer']);
                    toonVluchtinformatie($vluchtnummer, $db);
                } 

                //VIA VLUCHTENLIJST
                if (isset($_GET['id'])) {
                    $vluchtnummer = $_GET['id'];
                    toonVluchtinformatie($vluchtnummer, $db);
                } 
            ?>
        </div>
    </div>
</div>
</body>

</html>