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
    
<?php
// Controleer of een ID is doorgegeven vanuit de indexpagina
if (isset($_GET['id'])) {
    $passagierId = $_GET['id'];

    $passagierQuery = "SELECT * FROM Passagier WHERE passagiernummer = $passagierId";



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
    // Toon een foutmelding als er geen ID is doorgegeven
    echo "<p>Geen passagiersgegevens gevonden.</p>";
}
?>
    <div class="container">
        
    <?php include "../components/navbar.php" ?>
    <h1> Welkom bij Gelre-Check-In!</h1>
    <h2> Help u zelf en ga snel op reis!</h1>
   
    <div class="row">
    <?php       
    // CHECK ROLE                           
            // if (isset($_SESSION['rol'])) {
            //      $rol = $_SESSION['rol'];
            //   echo "Huidige rol: " . $rol;
            //     } else {
            //       echo "Rol niet ingesteld";
            //             }
                                                    ?>
                    <div class="item">
                    <h1>Passagiersgegevens:</h1>
                    <br>
                    <h2>Passagier ID: <?php echo $passagierId; ?></h2>
                    <p><strong>Naam:</strong> <?php echo $passagierNaam; ?></p>
                    <p><strong>Vluchtnummer:</strong> <?php echo $vluchtnummer; ?></p>
                    <p><strong>Geslacht:</strong> <?php echo $geslacht; ?></p>
                    <p><strong>Balienummer:</strong> <?php echo $balienummer; ?></p>
                    <p><strong>Stoel:</strong> <?php echo $stoel; ?></p>
                    <p><strong>Inchecktijdstip:</strong> <?php echo $inchecktijdstip; ?></p>
                    <div class="button"> Check In! </div>
</div>
            <div class="col-2">
                <img src="../images/checkin.png" class="checkin">
                <div class="color-box"></div> <!-- Awesome background effect, look for better photo -->
                <div class="add-btn"> <!-- try and find an awesome implimintation for this -->
                  
                   
                </div>
            </div>
        </div>



    </div>
</body>

</html>