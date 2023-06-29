

<?php
        // Functie om vluchtinformatie weer te geven
        function toonVluchtinformatie($vluchtnummer, $db) {
           

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