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
    <link rel="stylesheet" href="../css/vluchtenpagina.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> <!--custom font, might change later-->
</head>
<body>
    <div class="container">
        <?php include "../components/navbar.php" ?>
      <?php 
  if (isset($_SESSION['passagierid'])) {
    $passagiernummer = $_SESSION['passagierid'];

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
        echo "Objectvolgnummer bagage: " . $result['objectvolgnummer'] . "<br>";
        echo "Gewicht bagage: " . $result['gewicht'] . "<br>";
        echo "Inchecken balienummer: " . $result['inchecken_balienummer'] . "<br>";
    } else {
        echo "Geen gegevens gevonden voor de opgegeven passagier.";
    }
} else {
    echo "Geen passagiernummer (id) beschikbaar in de sessie.";
}
?>
    </div>
</body>
</html>
