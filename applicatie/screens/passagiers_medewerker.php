<?php
require_once '../starting/db_connectie.php';

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
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> <!--custom font, might change later-->
</head>
<body>
    <div class="container">
    <?php include "../components/navbar.php" ?>
        <h1>Geplande Vluchten</h1>
        <div class= "row">
</div>

<div class="table-body">
<?php
// Query 1: Gewichtslimiet overschreden
$query1 = "SELECT vluchtnummer, SUM(gewicht) AS totaalgewicht
           FROM Passagier p
           JOIN BagageObject b ON p.passagiernummer = b.passagiernummer
           GROUP BY vluchtnummer
           HAVING SUM(gewicht) > (
             SELECT max_totaalgewicht
             FROM Vlucht
             WHERE vluchtnummer = p.vluchtnummer
           )";

// Voer de query uit en haal de resultaten op
$result1 = $db->query($query1);

// Query 2: Passagierslimiet overschreden
$query2 = "SELECT vluchtnummer, COUNT(*) AS passagier_count
           FROM Passagier
           GROUP BY vluchtnummer
           HAVING COUNT(*) > (
             SELECT max_aantal
             FROM Vlucht
             WHERE vluchtnummer = Passagier.vluchtnummer
           )";

// Voer de query uit en haal de resultaten op
$result2 = $db->query($query2);

// Weergave van resultaten in een HTML-tabel
echo "<h2>Vluchten die niet aan de eisen voldoen:</h2>";
echo "<table>
        <tr>
          <th>Vluchtnummer</th>
          <th>Totaalgewicht</th>
          <th>Passagiersaantal</th>
        </tr>";

while ($row1 = $result1->fetch(PDO::FETCH_ASSOC)) {
    $vluchtnummer = $row1['vluchtnummer'];
    $totaalgewicht = $row1['totaalgewicht'];

    // Haal het passagiersaantal op uit resultaten 2
    $passagiersaantal = null;
    while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
        if ($row2['vluchtnummer'] == $vluchtnummer) {
            $passagiersaantal = $row2['passagier_count'];
            break;
        }
    }

    echo "<tr>
            <td>$vluchtnummer</td>
            <td>$totaalgewicht</td>
            <td>$passagiersaantal</td>
          </tr>";
}

echo "</table>";
echo"er zijn dus geen vluchten die het limiet hebben overschreden";

?>

</div>


  <br>
  <br>
    </div>
</body>

</html>
