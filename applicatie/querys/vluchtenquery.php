
<?php
require_once '../starting/db_connectie.php';

// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();


$vluchtQuery = 'select vluchtnummer, bestemming, gatecode, 
    	        vertrektijd 
                from Vlucht';

$data = $db->query($vluchtQuery);

$html_table = '<table>';
$html_table = $html_table . '
                            <tr>
                            <th>Vluchtnummer</th>
                            <th>Bestemming</th>
                            <th>Gatecode</th>
                            <th>Vertrektijd</th>
                            <th>Bekijk Vlucht</th>
                            </tr>
                            ';

while($rij = $data->fetch()) {
    $vluchtnummer = $rij['vluchtnummer'];
    $bestemming = $rij['bestemming'];
    $gatecode = $rij['gatecode'];
    $vertrektijd = $rij['vertrektijd'];
    
    $html_table = $html_table . "<tr>
                                <td>$vluchtnummer</td>
                                <td>$bestemming</td>
                                <td>$gatecode</td>
                                <td>$vertrektijd</td>
                                <td><a href='../screens/vluchtinfo.php'><button class='bekijkVlucht'>Bekijk</button></a></td>
                                </tr>";
  }

$html_table = $html_table . "</table>";

?>