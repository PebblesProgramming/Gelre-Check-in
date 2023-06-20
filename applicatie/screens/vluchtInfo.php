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
    <link rel="stylesheet" href="../css/vluchtenpagina.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> <!--custom font, might change later-->
</head>
<body>
    <div class="container">
        
    <?php include "../components/navbar.php" ?>
    <br>
    <section class="vluchtpagina">
        <img src="../images/vliegtuig.png"/>
        <section class="film_beschrijving">
        <?php 
            // Controleer of het vluchtnummer is doorgegeven via de URL-parameter
    if (isset($_GET['id'])) {
        // Vluchtnummer ophalen uit de URL-parameter
        $vluchtnummer = $_GET['id'];

    // this query executes the excact data I need for this page
    $query = "SELECT * FROM Vlucht WHERE vluchtnummer = '$vluchtnummer'";
    $resultaat = $db->query($query);

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

        echo '<h1>VluchtNummer: ' .$vluchtnummer. '</h1>';
        echo '<h1>Bestemming: ' .$bestemming. '</h1>';
        echo '<h1>GateCode: ' .$gatecode. '</h1>';
        echo '<h1>Maximaal aantal mensen: ' .$max_aantal. '</h1>';
        echo '<h1>Maximale gewicht P.P.: ' .$max_gewicht_pp. '</h1>';
        echo '<h1>Maximale totaalgewicht: ' .$max_totaalgewicht. '</h1>';
        echo '<h1>Vertrektijd: ' .$vertrektijd. '</h1>';
        echo '<h1>Maatshappijcode: ' .$maatschappijcode. '</h1>';
        } catch(Exception $e){
            //catch any errors if they are present
            echo 'Er is iets mis gegaan met de database probeer later opnieuw' .$e->getMessage();
            }
        }
    }  else{
        echo'ID is niet doorgekomen';
    }

            ?>
            <button class="actie">Boek</button><a href="#"></a>
        </section>

    </section>

</div>
    </div>
</body>
<?php include "../components/footer.php" ?>
</html>