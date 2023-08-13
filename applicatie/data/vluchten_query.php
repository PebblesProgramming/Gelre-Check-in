<?php
require_once '../db_connectie.php';
// Maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();
// Controleer of het formulier is verzonden
            if (isset($_POST["sort_order"])) {
                // Controleer of de sorteerwaarde is ingesteld
                $sort_order = $_POST["sort_order"];

                // Voeg de sorteervolgorde toe aan de query
                $vluchtQuery = "SELECT V.vluchtnummer, V.bestemming, V.gatecode, V.vertrektijd, L.naam AS luchthaven
                                FROM Vlucht V
                                JOIN Luchthaven L ON V.bestemming = L.luchthavencode
                                WHERE 1=1"; // Begin van de query

                // Controleer of de luchthavenwaarde is ingesteld
                if (isset($_POST["airport"])) {
                    // Ontvang de geselecteerde luchthavenwaarde
                    $selectedAirport = $_POST["airport"];

                    // Voeg de luchthavenfilter toe aan de query
                    $vluchtQuery .= " AND L.naam = '$selectedAirport'";
                }

                // Voeg de sorteervolgorde toe aan de query
                $vluchtQuery .= " ORDER BY V.vertrektijd $sort_order";
            } else {
                // Standaard sorteervolgorde en query als er geen formulier is verzonden
                $sort_order = "ASC";
                $selectedAirport = "";

                $vluchtQuery = "SELECT V.vluchtnummer, V.bestemming, V.gatecode, V.vertrektijd, L.naam AS luchthaven
                                FROM Vlucht V
                                JOIN Luchthaven L ON V.bestemming = L.luchthavencode
                                ORDER BY V.vertrektijd $sort_order";
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
                    <th>Luchthaven</th>
                   
                </tr>';

            while ($rij = $data->fetch()) {
                $vluchtnummer = $rij['vluchtnummer'];
                $bestemming = $rij['bestemming'];
                $gatecode = $rij['gatecode'];
                $vertrektijd = $rij['vertrektijd'];
                $luchthaven = $rij['luchthaven'];

                $html_table .= "  
                <tr onclick=\"window.location.href = '../public/vluchtinfo.php?id=$vluchtnummer';\">
                    <td>$vluchtnummer</td>
                    <td>$bestemming</td>
                    <td>$gatecode</td>
                    <td>$vertrektijd</td>
                    <td>$luchthaven</td>
                    
                </tr>";
            }

         $html_table .= "</table>";
        

         function displaySortForm()
         {
             ?>
             <form method="POST" action="">
                 <select name="sort_order">
                     <option value="ASC">Oplopend</option>
                     <option value="DESC">Aflopend</option>
                 </select>
                 <input type="submit" value="Sorteren">
             </form>
             <?php
         }
         
         function displayAirportFilterForm()
         {
             global $db;
         
             ?>
             <form method="POST" action="">
                 <input type="hidden" name="sort_order" value="<?php echo isset($_POST['sort_order']) ? $_POST['sort_order'] : ''; ?>">
                 <select name="airport">
                     <?php
                     $airportQuery = "SELECT naam FROM Luchthaven";
                     $airportData = $db->query($airportQuery);
         
                     while ($row = $airportData->fetch()) {
                         $airportName = $row['naam'];
                         echo "<option value='$airportName'>$airportName</option>";
                     }
                     ?>
                 </select>
                 <input type="submit" value="Filteren">
             </form>
             <?php
         }
         ?>
     
            