
<?php
    // Controleer of het vluchtnummer is doorgegeven via de URL-parameter
    if (isset($_GET['id'])) {
        // Vluchtnummer ophalen uit de URL-parameter
        $vluchtnummer = $_GET['id'];

    // this query executes the excact data I need for this page
    $query = "SELECT * FROM Vlucht WHERE vluchtnummer = '$vluchtnummer'";
    $resultaat = $db->query($query);

    $vluchtenLijst = '<ul>';
    $vluchtenLijst = $vluchtenLijst . '<ul>
        <li><h1>Vlucht:</h1></li>
        <li><h2>Bestemming:</h2></li>
        <li><h2>GateCode:</h2></li>
        <li><h2>Maximaal aantal mensen op de vlucht:</h2></li>
        <li><h2>Maximaal gewicht P.P.:</h2></li>
        <li><h2>Maximale totaalgewicht op de vlucht:</h2></li>
        <li><h2>Vertrektijd:</h2></li>
        <li><h2>Maatschappijcode</h2></li>';

   while($rij = $resultaat->fetch()){
    try{
        $vluchtnummer = $rij['vluchtnummer'];
        $bestemming = $rij['bestemming'];
        $gatecode = $rij['gatecode'];
        $max_aantal = $rij['max_aantal'];
        $max_gewicht_pp =$rij['max_gewicht_pp'];
        $max_totaalgewicht = $rij['max_totaalgewicht'];
        $vertrektijd = $rij['vertrektijd'];
        $maatschappijcode = $rij['maatschappijcode'];

     $vluchtenLijst = $vluchtenLijst."
     <ul>
     <li><h1>Vlucht: $vluchtnummer</h1></li>
     <li><h2>Bestemming:$bestemming</h2></li>
     <li><h2>Gatecode: $gatecode</h2></li>
     <li><h2>Maximaal aantal mensen op de vlucht:$max_aantal</h2></li>
     <li><h2>Maximaal gewicht P.P.: $max_gewicht_pp</h2></li>
     <li><h2>Maximale totaalgewicht op de vlucht:  $max_totaalgewicht</h2></li>
     <li><h2>Vertrektijd: $vertrektijd </h2></li>
     <li><h2>Maatschappijcode: $maatschappijcode</h2></li>
 </ul> ";   
        $vluchtenLijst = $vluchtenLijst . "</ul>";
        } catch(Exception $e){
            //catch any errors if they are present
            echo 'Er is iets mis gegaan met de database probeer later opnieuw' .$e->getMessage();
            }
        }
    } 

    $gebruikersRol = 'medewerker';

    if($gebruikersRol == 'passagier'){
        //show the boek button
        echo ' <button class="actie">Boek</button><a href="#"></a>';
    }
    if($gebruikersRol == 'medewerker'){
        // show adjust button
        echo ' <button class="actie">Pas aan</button><a href="#"></a>';
    }
?>