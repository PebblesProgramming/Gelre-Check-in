<?php
session_start();
require_once '../applicatie/starting/db_connectie.php';

// Maak verbinding met de database (zie db_connectie.php)
$db = maakVerbinding();


// Check voor het wachtwoord
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "De code voor het medewerkersformulier wordt uitgevoerd.";

    // Controleer of het ingevoerde balienummer en wachtwoord niet leeg zijn
    if (!empty($_POST['balienummer']) && !empty($_POST['wachtwoord'])) {
        $ingevoerdBalienummer = $_POST['balienummer'];
        $ingevoerdWachtwoord = $_POST['wachtwoord'];

        // Query om het wachtwoord van de geselecteerde balie op te halen
        $query = "SELECT * FROM Balie WHERE balienummer = :balienummer";
        $statement = $db->prepare($query);
        $statement->bindParam(':balienummer', $ingevoerdBalienummer);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Controleer of de balie is gevonden in de database
        if ($result) {
            $correctWachtwoord = $result['wachtwoord'];
        $correctWachtwoord = password_hash($correctWachtwoord, PASSWORD_DEFAULT);

    // Controleer of het ingevoerde wachtwoord overeenkomt met het gehashte wachtwoord
    if (password_verify($ingevoerdWachtwoord, $correctWachtwoord)) {
        // Inloggen is gelukt, sla het balienummer op in de sessie
        $_SESSION['ingelogd'] = true;
        $_SESSION['balienummer'] = $ingevoerdBalienummer; // zodat ik bij alle medewerker paginas alleen bij de info kan die voor deze balie bedoeld is
        $_SESSION['rol'] = 'medewerker';
        header("refresh:2;url=../screens/medewerker.php");
        echo 'Medewerker wordt ingelogd! Je wordt doorverwezen.';
        exit;
    } else {
        $foutmeldingMedewerker = "Ongeldig wachtwoord";
        echo $ingevoerdBalienummer;
        echo $ingevoerdWachtwoord;
        echo $correctWachtwoord;
        echo $result['balienummer'];
    }
} else {
    $foutmeldingMedewerker = "Ongeldig balienummer";
}
    } else {
        $foutmeldingMedewerker = "Vul een balienummer en wachtwoord in";
    }
}




    // Controleer of het passagiernummer is ingevuld
    if (!empty($_POST['passagiernummer'])) {
        $ingevoerdPassagiernummer = $_POST['passagiernummer'];

        // Query om de passagiergegevens op te halen op basis van het ingevoerde passagiernummer
        $query = "SELECT passagiernummer FROM Passagier WHERE passagiernummer = :passagiernummer";
        $statement = $db->prepare($query);
        $statement->bindParam(':passagiernummer', $ingevoerdPassagiernummer);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Controleer of de passagier is gevonden in de database
        if ($result) {
            // Inloggen is gelukt, sla het passagiernummer op in de sessie
            header("refresh:2;url= ../screens/passagier.php?id=$ingevoerdPassagiernummer");
            $_SESSION['ingelogd'] = true;
            $_SESSION['rol'] = 'passagier';
            $_SESSION['passagierid'] = $ingevoerdPassagiernummer;// zodat ik op de hele passagier kant bij de juiste info kan
            echo'passagier word ingelogd';
            exit;
        } else {
            // Inloggen is mislukt, toon een foutmelding
            $foutmeldingPassagier = "Ongeldig passagiernummer";
        }
    } else {
        // Inloggen is mislukt, toon een foutmelding
        $foutmeldingPassagier = "Vul een passagiernummer in";
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
        <?php if(isset($foutmeldingMedewerker)){
            echo "<p>$foutmeldingMedewerker</p>";
        }?>
    </form>
</div>
        <div class="container">
        <h1>Inloggen als passagier</h1>
        <form method="POST" action="index.php">
            <label for="passagiernummer">Passagiernummer:</label>
            <input type="text" id="passagiernummer" name="passagiernummer" required>
            <input class="button" type="submit" value="Inloggen">
            <?php if(isset($foutmeldingPassagier)){
                echo "<p>$foutmeldingPassagier</p>";
            }?>
        </form>
    </div>
    </div>
</body>
</html>
