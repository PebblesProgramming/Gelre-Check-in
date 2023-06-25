<!DOCTYPE html>
<?php
require_once '../starting/db_connectie.php';
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
        <?php include "../components/navbar.php" ?>
        <div class="item">
            <?php 
            $passagiernummer = null;

            if (isset($_SESSION['passagierid'])) {
                $passagiernummer = $_SESSION['passagierid'];
            } elseif (isset($_GET['passagiernummer'])) {
                $passagiernummer = $_GET['passagiernummer'];
            }

            if ($passagiernummer !== null) {
                $query = "SELECT P.naam AS passagier_naam, V.vluchtnummer, V.vertrektijd, V.bestemming, G.gatecode, L.naam AS luchthaven_naam, B.objectvolgnummer, B.gewicht, IB.balienummer AS inchecken_balienummer
                          FROM Passagier AS P
                          JOIN Vlucht AS V ON P.vluchtnummer = V.vluchtnummer
                          LEFT JOIN Gate AS G ON V.gatecode = G.gatecode
                          JOIN Luchthaven AS L ON V.bestemming = L.luchthavencode
                          LEFT JOIN BagageObject AS B ON P.passagiernummer = B.passagiernummer
                          LEFT JOIN IncheckenBestemming AS IB ON L.luchthavencode = IB.luchthavencode
                          WHERE P.passagiernummer = :passagiernummer";

                $statement = $db->prepare($query);
                $statement->bindParam(':passagiernummer', $passagiernummer);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                if ($result) {
                    echo "<h1> Vluchtnummer: " . $result['vluchtnummer'] ." </h1><br>";
                    echo "Naam passagier: " . $result['passagier_naam'] . "<br>";
                    echo "Vertrektijd: " . $result['vertrektijd'] . "<br>";
                    echo "Bestemming: " . $result['bestemming'] . "<br>";
                    echo "Gatecode: " . $result['gatecode'] . "<br>";
                    echo "Luchthaven: " . $result['luchthaven_naam'] . "<br>";
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
                $bagageQuery = "SELECT passagiernummer, objectvolgnummer, gewicht FROM BagageObject WHERE passagiernummer = :passagiernummer";
                $statement = $db->prepare($bagageQuery);
                $statement->bindParam(':passagiernummer', $passagiernummer);
                $statement->execute();
                $bagageResult = $statement->fetchAll(PDO::FETCH_ASSOC);

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

        <?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Haal de ingediende gegevens op
    $passagiernummer = $_POST['passagiernummer'];
    $gewicht = $_POST['gewicht'];
    $query = "SELECT MAX(objectvolgnummer) AS max_objectvolgnummer FROM BagageObject WHERE passagiernummer = :passagiernummer";
    $statement = $db->prepare($query);
    $statement->bindParam(':passagiernummer', $passagiernummer);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    // als dit het eerste object is word het 0 anders word het 1
    $objectvolgnummer = $result['max_objectvolgnummer'] !== null ? $result['max_objectvolgnummer'] + 1 : 0;

    // Haal het totale gewicht van de bagage van de passagier op
    $query = "SELECT SUM(gewicht) AS totaal_gewicht FROM BagageObject WHERE passagiernummer = :passagiernummer";
    $statement = $db->prepare($query);
    $statement->bindParam(':passagiernummer', $passagiernummer);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //als er nog geen totaalgewicht is, wordt het huidige gewicht als het totaalgewicht gebruikt. anders word het op bestaande opgeteld
    $totaal_gewicht = $result['totaal_gewicht'] !== null ? $result['totaal_gewicht'] + $gewicht : $gewicht;

    // Haal het maximale gewicht per persoon op uit de Vlucht-tabel
    $query = "SELECT max_gewicht_pp FROM Vlucht WHERE vluchtnummer = :vluchtnummer";
    $statement = $db->prepare($query);
    $statement->bindParam(':vluchtnummer', $vluchtnummer); // Zorg ervoor dat je het vluchtnummer hebt, zodat je het kunt binden aan de parameter
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $max_gewicht_pp = $result['max_gewicht_pp'];

    // Controleer of het totale gewicht per persoon het maximale gewicht overschrijdt
    if ($totaal_gewicht > $max_gewicht_pp) {
        echo "Fout: Het totale gewicht per persoon overschrijdt het maximale gewicht toegestaan voor deze vlucht.";
        return; // Stop de verdere verwerking als er een fout is opgetreden
    }

    // Bereid de SQL-query voor
    $query = "INSERT INTO BagageObject (passagiernummer, objectvolgnummer, gewicht)
              VALUES (:passagiernummer, :objectvolgnummer, :gewicht)";

    // Maak een prepared statement
    $statement = $db->prepare($query);

    // Bind de waarden aan de parameters
    $statement->bindParam(':passagiernummer', $passagiernummer);
    $statement->bindParam(':objectvolgnummer', $objectvolgnummer);
    $statement->bindParam(':gewicht', $gewicht);

    // Voer de query uit
    if ($statement->execute()) {
        echo "Bagage is succesvol toegevoegd.";
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van de bagage.";
    }
}

?>
<h2>Bagage toevoegen</h2>
<form action="" method="POST">
    <input type="hidden" name="passagiernummer" value="<?php echo $passagiernummer; ?>">
    <input type="hidden" name="objectvolgnummer" value="<?php echo $objectvolgnummer; ?>">
    <label for="gewicht">Gewicht:</label>
    <input type="text" name="gewicht" id="gewicht" required>
    <button type="submit">Toevoegen</button>
</form>

