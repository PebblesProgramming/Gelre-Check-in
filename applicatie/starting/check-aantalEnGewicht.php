<?php
require_once '../starting/db_connectie.php';
// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();

function checkVluchtenEisen($db) {
    //Kijkt of er aan de eisen van de opdrachtgever word voldaan

    // Query 1: Gewichtslimiet overschreden
    $gewicht = "SELECT vluchtnummer, SUM(gewicht) AS totaalgewicht
               FROM Passagier p
               JOIN BagageObject b ON p.passagiernummer = b.passagiernummer
               GROUP BY vluchtnummer
               HAVING SUM(gewicht) > (
                 SELECT max_totaalgewicht
                 FROM Vlucht
                 WHERE vluchtnummer = p.vluchtnummer
               )";

    // Voer de query uit en haal de resultaten op
    $gewichtResultaat = $db->query($gewicht);

    // Query 2: Passagierslimiet overschreden
    $passagiers = "SELECT vluchtnummer, COUNT(*) AS passagier_count
               FROM Passagier
               GROUP BY vluchtnummer
               HAVING COUNT(*) > (
                 SELECT max_aantal
                 FROM Vlucht
                 WHERE vluchtnummer = Passagier.vluchtnummer
               )";

    // Voer de query uit en haal de resultaten op
    $passagierResultaat = $db->query($passagiers);

    echo "<h2>Vluchten die niet aan de eisen voldoen:</h2>";

    while ($rijgewicht = $gewichtResultaat->fetch(PDO::FETCH_ASSOC)) {
        $vluchtnummer = $rijgewicht['vluchtnummer'];

        echo "Vluchtnummer: $vluchtnummer (Fout: Gewichtslimiet overschreden)<br>";
    }

    while ($rijpassagiers = $passagierResultaat->fetch(PDO::FETCH_ASSOC)) {
        $vluchtnummer = $rijpassagiers['vluchtnummer'];

        echo "Vluchtnummer: $vluchtnummer (Fout: Passagierslimiet overschreden)<br>";
    }

    if ($gewichtResultaat->rowCount() === 0 && $passagierResultaat->rowCount() === 0) {
        echo "Er zijn geen vluchten die het limiet hebben overschreden.";
    }
}

?>