<?php
require_once '../db_connectie.php';
require_once '../data/vluchten_query.php';
// Maak verbinding met de database (zie db_connection.php)
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
    <link rel="stylesheet" href="../css/vluchten.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'>
</head>
<body>
    <div class="container">
    <?php include "../public/navbar.php" ?>
        <h1>Geplande Vluchten</h1>
        <?php
          if (isset($_SESSION['rol'])) {
            $rol = $_SESSION['rol'];
            if($rol == 'medewerker'){
            echo '';
            } else{
                echo' <h2> Neem een kijkje naar alle vluchten! </h2><br>';
            }
          }
  ?>
        <div class= "row">
            <!-- voor de tijden -->
            <?php
            displaySortForm();
             displayAirportFilterForm();

             ?>
        </div>
        <div class="table-body">
            <?php
            echo $html_table;
            ?>
        </div>

        <br>
        <br>
    </div>
</body>
</html>
