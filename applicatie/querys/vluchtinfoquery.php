
<?php
require_once '../starting/db_connectie.php';
require_once '../querys/vluchtenquery.php';

$db = maakVerbinding();

// first get the vluchtnummer based on the flight were you clicked
$infoQuery = 'select vluchtnummer, bestemming, gatecode, max_aantal, 
                max_gewicht_pp, max_totaalgewicht, vertrektijd, maatschappijcode
                from Vlucht 
                where vluchtnummer = '.$vluchtnummer.'
             ';
             
$data = $db->query($infoQuery);


?>