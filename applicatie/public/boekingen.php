<!DOCTYPE html>
<?php
require_once '../db_connectie.php';
require_once '../data/boekingenQuerys.php';
require_once '../app/filterInput_functie.php';
// Maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();
?>
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
        <div class="item">
            <?php 
            if (isset($_SESSION['passagierid'])) {
                $passagiernummer = $_SESSION['passagierid'];
            } elseif (isset($_GET['passagiernummer'])) {
                $passagiernummer = $_GET['passagiernummer'];
            }

            if ($passagiernummer !== null) {
                $result = getPassagierGegevens($passagiernummer,$db);

                if ($result) {
                    echo "<h1> Vluchtnummer: " . $result['vluchtnummer'] ." </h1><br>";
                    echo "Naam passagier: " . $result['passagier_naam'] . "<br>";
                    echo "Vertrektijd: " . $result['vertrektijd'] . "<br>";
                    echo "Bestemming: " . $result['bestemming'] . "<br>";
                    echo "Gatecode: " . $result['gatecode'] . "<br>";
                    echo "Luchthaven: " . $result['luchthaven_naam'] . "<br>";
                    echo "Maximaal Gewicht aan bagage: " .$result['max_gewicht_pp'] . "<br>";
                    echo "Inchecken balienummer: " . $result['inchecken_balienummer'] . "<br>";
                } else {
                    echo "Geen gegevens gevonden voor de opgegeven passagier.";
                }
            } else {
                echo "Geen passagiernummer beschikbaar in de sessie of URL.";
            }
            ?>
        </div>
        <div class="item">
            <?php
            if ($passagiernummer !== null) {
                $bagageResult = getBagage($passagiernummer,$db);

                if ($bagageResult) {
                    echo "<h2>Bagage</h2>";
                    foreach ($bagageResult as $bagage) {
                        $passagiernummer = $bagage['passagiernummer'];
                        $objectvolgnummer = $bagage['objectvolgnummer'];
                        $gewicht = $bagage['gewicht'];
                        echo "Passagiernummer:  $passagiernummer <br>";
                        echo "Objectvolgnummer: $objectvolgnummer<br>";
                        echo "Gewicht: $gewicht<br><br>";
                    }
                } else {
                    echo "Geen bagage gevonden voor de opgegeven passagier.";
                }
            } else {
                echo "Geen passagiernummer beschikbaar in de sessie of URL.";
            }
            ?>
            <?php if ($bagageResult && $bagage['objectvolgnummer'] !== null) { ?>
                <H3>Ingechecked</h3>
            <?php } ?>
        </div>
        <div class="item">
            <h2>Bagage toevoegen</h2>
            <form action="" method="POST">
                <input type="hidden" name="passagiernummer" value="<?php echo $passagiernummer; ?>">
                <input type="hidden" name="objectvolgnummer" value="<?php echo $objectvolgnummer; ?>">
                <label for="gewicht">Gewicht:</label>
                <input type="text" name="gewicht" id="gewicht" required>
                <button type="submit">Toevoegen</button>
            </form>
            <?php
                
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Controleer of de vereiste formuliervelden zijn ingevuld
                if (isset($_POST['passagiernummer']) && isset($_POST['objectvolgnummer']) && isset($_POST['gewicht'])) {
                    $passagiernummer = $_POST['passagiernummer'];
                    $objectvolgnummer = $_POST['objectvolgnummer'];
                    $gewicht = filterInput($_POST['gewicht']);

                    // Roep de functie voegBagageToe aan
                    $result = voegBagageToe($passagiernummer, $objectvolgnummer, $gewicht, $db);

                    // Toon het resultaatbericht
                    echo $result;
                } else {
                    echo "Fout: Niet alle vereiste velden zijn ingevuld.";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
