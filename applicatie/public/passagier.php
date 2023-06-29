<?php
require_once '../db_connectie.php';
require_once '../data/passagierData.php';
require_once '../app/passagier_functie.php';
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
    <?php include "../public/navbar.php" ?>
 
<?php
    if (isset($_SESSION['passagierid'])) {
    $passagiernummer = $_SESSION['passagierid'];
    $passengerData = getPassengerData($passagiernummer, $db);

    if (!$passengerData) {
        echo "Geen passagiersgegevens gevonden.";
        exit;
    }
    displayPassengerDetails($passengerData);
} else {
    echo "Geen passagiernummer beschikbaar in de sessie.";
}
?>
        </div>
    </div>
</body>

</html>