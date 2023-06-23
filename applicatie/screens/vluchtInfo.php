<?php

require_once '../starting/db_connectie.php';

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
<?php include "../components/navbar.php" ?>
    <div class="container2">

       <div class="item">
        <?php 
        // Functie om vluchtinformatie weer te geven
        function toonVluchtinformatie($vluchtnummer) {
            global $db;

            // Voorbereiden van de query met een prepared statement
            $query = "SELECT * FROM Vlucht WHERE vluchtnummer = :vluchtnummer";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':vluchtnummer', $vluchtnummer, PDO::PARAM_STR);

            // Uitvoeren van de prepared statement
            if ($stmt->execute()) {
                $vlucht = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($vlucht) {
                    echo '<h1> Vlucht: <h1>';
                    echo '<h3>VluchtNummer: ' .$vlucht['vluchtnummer']. '</h3>';
                    echo '<h3>Bestemming: ' .$vlucht['bestemming']. '</h3>';
                    echo '<h3>GateCode: ' .$vlucht['gatecode']. '</h3>';
                    echo '<h3>Maximaal aantal mensen: ' .$vlucht['max_aantal']. '</h3>';
                    echo '<h3>Maximale gewicht P.P.: ' .$vlucht['max_gewicht_pp']. '</h3>';
                    echo '<h3>Maximale totaalgewicht: ' .$vlucht['max_totaalgewicht']. '</h3>';
                    echo '<h3>Vertrektijd: ' .$vlucht['vertrektijd']. '</h3>';
                    echo '<h3>Maatshappijcode: ' .$vlucht['maatschappijcode']. '</h3>';
                } else {
                    echo "<p>Geen info gevonden voor vluchtnummer: " . $vluchtnummer . "</p>";
                }
            } else {
                echo "<p>Er is een fout opgetreden bij het ophalen van de vluchtinformatie.</p>";
            }
        }
                //ZOEKOPDRACHT
                if (isset($_GET['vluchtnummer'])) {
                    $vluchtnummer = $_GET['vluchtnummer'];
                    toonVluchtinformatie($vluchtnummer);
                } 

                //VIA VLUCHTENLIJST
                if (isset($_GET['id'])) {
                    $vluchtnummer = $_GET['id'];
                    toonVluchtinformatie($vluchtnummer);
                } 
            ?>
            <button class="actie">Boek</button><a href="#"></a>
        </div>

        
        <!--PASSAGIERSLIJST-->
        <div class="item">
        <?php 
            ?>
        </div>
    
    </div>
</div>
</body>

</html>