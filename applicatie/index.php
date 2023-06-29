<?php
// Plaats hier de code voor het tonen van het inlogscherm en het verwerken van de inloggegevens
session_start();
require_once '../applicatie/db_connectie.php'; 
require_once '../applicatie/app/inloggen_functie.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    medewerkerInloggen();
    passagierInloggen();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kies Rol</title>
    <link rel="stylesheet" href="../css/rol_keuze.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> <!--custom font, might change later-->
</head>
<body>
    <div class="container">
        <div class="role-selectie">
            <h1>Welkom bij Gelre Check-In</h1>
            <h3>Kies welke rol u heeft:</h3>
        </div>
        <div class="container">
            <h1>Inloggen als medewerker</h1>
            <form method="POST" action="index.php">
                <br>
                <label for="balienummer">Balienummer:</label>
                <input type="text" id="balienummer" name="balienummer" required>
                <br>
                <label for="wachtwoord">Wachtwoord:</label>
                <input type="password" id="wachtwoord" name="wachtwoord" required>
                <br>
                <input class="button" type="submit" value="Inloggen">
            </form>
        </div>
        <div class="container">
            <h1>Inloggen als passagier</h1>
            <form method="POST" action="index.php">
                <label for="passagiernummer">Passagiernummer:</label>
                <input type="text" id="passagiernummer" name="passagiernummer" required>
                <input class="button" type="submit" value="Inloggen">
            </form>
           
        </div>
    </div>
</body>
</html>

