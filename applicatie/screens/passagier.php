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
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> 
</head>
<body>
    <div class="container">  
    <?php include "../components/navbar.php" ?>
    <?php
if (isset($_SESSION['passagierid'])) {
    $passagiernummer = $_SESSION['passagierid'];
    $passagierQuery = "SELECT * FROM Passagier WHERE passagiernummer = $passagiernummer";
    $passagier = $db->prepare($passagierQuery);
    $passagier = $db->query($passagierQuery); // dit is de netste manier 
   while($rij = $passagier->fetch()){
    try{
        $passagierId = $rij['passagiernummer'];
        $passagierNaam = $rij['naam'];
        $vluchtnummer = $rij['vluchtnummer'];
        $geslacht = $rij['geslacht'];
        $balienummer = $rij['balienummer'];
        $stoel = $rij['stoel'];
        $inchecktijdstip = $rij['inchecktijdstip'];

    }catch(Exception $e){
        echo 'er is iets mis gegaan met de database probeer het later opnieuw' .$e->getMessage();
        }
    }  
}else {
    //foutmelding als er geen ID is doorgegeven
    echo "<p>Geen passagiersgegevens gevonden.</p>";
}
?>
    <h1> Welkom bij Gelre-Check-In!</h1>
    <div class="row">
                    <div class="col-1">
                    <h1>Passagiersgegevens:</h1>
                    <br>
                    <h2>Passagier ID: <?php echo $passagierId; ?></h2>
                    <p><strong>Naam:</strong> <?php echo $passagierNaam; ?></p>
                    <p><strong>Vluchtnummer:</strong> <?php echo $vluchtnummer; ?></p>
                    <p><strong>Geslacht:</strong> <?php echo $geslacht; ?></p>
                    <p><strong>Balienummer:</strong> <?php echo $balienummer; ?></p>
                    <p><strong>Stoel:</strong> <?php echo $stoel; ?></p>
                    <p><strong>Inchecktijdstip:</strong> <?php echo $inchecktijdstip; ?></p>
</div>
            <div class="col-2">
                <img src="../images/checkin.png" class="checkin">
                <div class="color-box"></div> 
                <div class="add-btn"> 
                  
                   
                </div>
            </div>
        </div>



    </div>
</body>

</html>