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
    <link rel="stylesheet" href="../css/vluchten.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> <!--custom font, might change later-->
</head>
<body>
    <div class="container">
    <?php include "../components/navbar.php" ?>
        <h1>Geplande Vluchten</h1>
        <div class= "row">
    <!-- voor de vlucht -->
    <form method="POST" action="">
        <select name="sort_order">
            <option value="ASC">Oplopend</option>
            <option value="DESC">Aflopend</option>
        </select>
        <input type="submit" value="Sorteren">
    </form>

    <!-- voor de vluchthavens -->
    <form method="POST" action="">
        <select name="airport">
            <?php
            // Query om alle luchthavens op te halen uit de tabel "Luchthaven"
            $airportQuery = "SELECT naam FROM Luchthaven";
            $airportData = $db->query($airportQuery);

            // Loop door de resultaten en genereer de opties voor de dropdown
            while ($row = $airportData->fetch()) {
                $airportName = $row['naam'];
                echo "<option value='$airportName'>$airportName</option>";
            }
            ?>
        </select>
        <input type="submit" value="Filteren">
    </form>
</div>

<div class="table-body">
    <?php
    // Controleer of het formulier is verzonden
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Controleer of de sorteerwaarde is ingesteld
        if (isset($_POST["sort_order"])) {
            // Ontvang de geselecteerde sorteerwaarde
            $sort_order = $_POST["sort_order"];

            // Voeg de sorteervolgorde toe aan de query
            $vluchtQuery = "SELECT vluchtnummer, bestemming, gatecode, vertrektijd 
                            FROM Vlucht 
                            ORDER BY vertrektijd $sort_order";
        }

        // Controleer of de luchthavenwaarde is ingesteld
        if (isset($_POST["airport"])) {
            // Ontvang de geselecteerde luchthavenwaarde
            $selectedAirport = $_POST["airport"];

            // Voeg de luchthavenfilter toe aan de query
            $vluchtQuery = "SELECT vluchtnummer, bestemming, gatecode, vertrektijd, luchthaven 
                            FROM Vlucht 
                            WHERE luchthaven = '$selectedAirport'
                            ORDER BY vertrektijd $sort_order";
        }
    } else {
        // Standaard query als er geen sorteervolgorde is ingesteld
        $vluchtQuery = "SELECT vluchtnummer, bestemming, gatecode, vertrektijd 
                        FROM Vlucht";
    }

    // Voer de query uit om de vluchten op te halen
    $data = $db->query($vluchtQuery);

    $html_table = '<table>';
    $html_table .= '
        <tr>
            <th>Vluchtnummer</th>
            <th>Bestemming</th>
            <th>Gatecode</th>
            <th>Vertrektijd</th>
            <th>Gewicht</th>
            <th>Aantal Passagiers</th>
            <th>Status</th>
        </tr>';

    while ($rij = $data->fetch()) {
        $vluchtnummer = $rij['vluchtnummer'];
        $bestemming = $rij['bestemming'];
        $gatecode = $rij['gatecode'];
        $vertrektijd = $rij['vertrektijd'];

        $html_table .= "  
        <tr onclick=\"window.location.href = '../screens/vluchtinfo.php?id=$vluchtnummer';\">
        <td>$vluchtnummer</td>
            <td>$bestemming</td>
            <td>$gatecode</td>
            <td>$vertrektijd</td>
            <td>Gewicht</td>
            <td>Aantal passagies</td>
            <td>Status</td>
        </tr>";
    }

    $html_table .= "</table>";

    echo $html_table;
    ?>
</div>


  <br>
  <br>
    </div>
</body>

</html>