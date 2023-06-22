<?php
session_start();
require_once '../applicatie/starting/db_connectie.php';
// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();

// Het statische wachtwoord dat gehasht moet worden
$wachtwoord = "12345"; 
// Hash het wachtwoord
$gehashtWachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Controleer of het wachtwoord is ingevuld
    if (!empty($_POST['wachtwoord'])) {
        // Het ingevoerde wachtwoord bij het inloggen
        $ingevoerdWachtwoord = $_POST['wachtwoord'];

        // Het gehashte wachtwoord uit de database
        //$gehashtWachtwoord = "$2y$10$21FuTBFO7A6RsZS2p6B9p.OOwH6cG5CN4/zrXxuPbUEnku.5X3rJi";

        // Controleer of het ingevoerde wachtwoord niet leeg is en overeenkomt met het gehashte wachtwoord
        if (!empty($ingevoerdWachtwoord) && password_verify($ingevoerdWachtwoord, $gehashtWachtwoord)) {
            echo 'inloggen is gelukt';
            // Inloggen is gelukt, stuur de gebruiker naar de medewerkerspagina
            header("refresh:2;url=../screens/medewerker.php");// de refresh 2 is voor mijzelf als check zodat ik zeker weet dat het inloggen is gelukt
            
            exit; // Stop de rest van de code, omdat het inloggen is geslaagd
        } else {
            // Inloggen is mislukt, toon een foutmelding
            $foutmelding = "Ongeldig wachtwoord";
        }
    } else {
        // Inloggen is mislukt, toon een foutmelding
        $foutmelding = "Vul een wachtwoord in";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kies Rol</title>
    <!--<link rel="stylesheet" href="/css/style.css">-->
    <link rel="stylesheet" href="../css/rol_keuze.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> <!--custom font, might change later-->
</head>
<body>
    <div class="container">
        <div class="rol-selectie">
        <h1>Welkom bij Gelre Check-In</h1>
        <h3>Kies welke rol u heeft: </h3>
        <div>
    </div>
    <div class="container">
        <h1>Inloggen als medewerker</h1>
    <form method="POST" action="index.php">
        <label for="medewerkercode">Medewerkercode:</label>
        <input type="password" id="medewerkercode" name="wachtwoord" required>
        <input class="button" type="submit" value="Inloggen">
        <?php if(isset($foutmelding)){
            echo "<p>$foutmelding</p>";
            }?>
    </form>
    </div>
    <div class="container">
    <h1>Ga door als Passagier</h1>
    <form method="POST" action="../screens/passagier.php">
        <label for="medewerkercode">Passagier nummer:</label>
        <input type="password" id="medewerkercode" name="medewerkercode" required>
        <input class="button" type="submit" value="Inloggen">
    </form>
    </div>  
    </div>
</body>
</html>
