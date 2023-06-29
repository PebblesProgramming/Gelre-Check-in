<?php
require_once '../db_connectie.php';
require_once '../app/passagierToevoegen_functie.php';

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
    <link rel="stylesheet" href="../css/vluchtenpagina.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> 
</head>
<body>
    <div class="container">
    <?php include "../public/navbar.php" ?>
        <div class="container2">
            <div class="item">
                <h1> Passagier toevoegen</h1>
                <form method="POST" action="">
                    <input type="number" name="passagiernummer" placeholder="Passagiernummer" required>
                    <input type="text" name="naam" placeholder="Naam" required>
                    <input type="number" name="vluchtnummer" placeholder="Vluchtnummer" required>
                    <input type="text" name="geslacht" placeholder="Geslacht">
                    <input type="number" name="balienummer" placeholder="Balienummer">
                    <input type="text" name="stoel" placeholder="Stoel">
                    <input type="datetime-local" name="inchecktijdstip" placeholder="Inchecktijdstip">
                    <input class="button" type="submit" value="Toevoegen">
                </form>

                <?php
                voegPassagierToe($db);
               ?>
            </div>
        </div>
    </div>
</body>
</html>
