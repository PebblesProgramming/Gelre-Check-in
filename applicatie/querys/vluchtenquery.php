
<?php
require_once '../starting/db_connectie.php';

// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();


$vluchtQuery = 'select vluchtnummer, bestemming, gatecode, 
    	        max_aantal, max_gewicht_pp, max_totaalgewicht ,vertrektijd, maatschappijcode 
                from Vlucht';
// haal alle componisten op en tel het aantal stukken
// $query = 'select c.componistId as id, c.naam as naam, count(S.stuknr) as aantal
//           from Componist C left outer join Stuk S on C.componistId = S.componistId
//           group by C.componistId, C.naam
//           order by naam';

//$data = $db->query($query);
$data = $db->query($vluchtQuery);

$html_table = '<table>';
$html_table = $html_table . '<tr>
                            <th>vluchtnummer</th>
                            <th>bestemming</th>
                            <th>gatecode</th>
                            <th>max_aantal</th>
                            <th>max_gewicht_pp</th>
                            <th>max_totaalgewicht</th>
                            <th>vertrektijd</th>
                            <th>maatschappijcode</th>
                            </tr>';

// while($rij = $data->fetch()) {
//   $id = $rij['id'];
//   $naam = $rij['naam'];
//   $aantal = $rij['aantal'];
  
//   $html_table = $html_table . "<tr><td>$id</td><td>$naam</td><td>$aantal</td></tr>";
// }

while($rij = $data->fetch()) {
    $vluchtnummer = $rij['vluchtnummer'];
    $bestemming = $rij['bestemming'];
    $gatecode = $rij['gatecode'];
    $max_aantal = $rij['max_aantal'];
    $max_gewicht_pp = $rij['max_gewicht_pp'];
    $max_totaal = $rij['max_totaalgewicht'];
    $vertrektijd = $rij['vertrektijd'];
    $maatschappijcode = $rij['maatschappijcode'];
    
    $html_table = $html_table . "<tr>
                                <td>$vluchtnummer</td>
                                <td>$bestemming</td>
                                <td>$gatecode</td>
                                <td>$max_aantal</td>
                                <td>$max_gewicht_pp</td>
                                <td>$max_totaal</td>
                                <td>$vertrektijd</td>
                                <td>$maatschappijcode</td>
                                </tr>";
  }

$html_table = $html_table . "</table>";

?>