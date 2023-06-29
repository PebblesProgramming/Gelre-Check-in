<?php
require_once '../db_connectie.php';
require_once '../app/vluchtToevoegen_functie.php';

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
    <link rel="stylesheet" href="../css/vluchtenpagina.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> 
</head>
<body>
    <div class="container">
        <?php include "../public/navbar.php" ?>
        <div class="container2">
            <div class="item">
                <h1> Vlucht toevoegen</h1>
                <form method="POST" action="">
                    <input type="number" name="vluchtnummer" placeholder="Vluchtnummer" required>
                    <input type="text" name="bestemming" placeholder="Bestemming" required>
                    <input type="text" name="gatecode" placeholder="Gatecode">
                    <input type="number" name="max_aantal" placeholder="Maximaal aantal" required>
                    <input type="number" step="0.01" name="max_gewicht_pp" placeholder="Maximaal gewicht per passagier" required>
                    <input type="number" step="0.01" name="max_totaalgewicht" placeholder="Maximaal totaalgewicht" required>
                    <input type="datetime-local" name="vertrektijd" placeholder="Vertrektijd">
                    <input type="text" name="maatschappijcode" placeholder="Maatschappijcode" required>
                    <input class="button" type="submit" value="Toevoegen">
                </form>

                <?php
                    voegVluchtToe($db);
                 ?>
        </div>
    </div>
</body>
</html>
