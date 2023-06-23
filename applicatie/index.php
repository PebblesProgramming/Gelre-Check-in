<?php
session_start();
require_once '../applicatie/starting/db_connectie.php';

// Maak verbinding met de database (zie db_connectie.php)
$db = maakVerbinding();

// // Het statische wachtwoord dat gehasht moet worden
// $wachtwoord = "12345";
// // Hash het wachtwoord
// $gehashtWachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     // Controleer of het medewerkercode is ingevuld
//     if (!empty($_POST['medewerkercode'])) {
//         // Het ingevoerde medewerkercode bij het inloggen
//         $ingevoerdeMedewerkercode = $_POST['medewerkercode'];

//         // Controleer of de ingevoerde medewerkercode overeenkomt met het statische wachtwoord
//         if (password_verify($ingevoerdeMedewerkercode, $gehashtWachtwoord)) {
//             // Medewerkercode is correct, inloggen is gelukt
//             $_SESSION['medewerkercode'] = $ingevoerdeMedewerkercode;
//             // Inloggen is gelukt, stel de sessievariabele in
//              $_SESSION['ingelogd'] = true;
//             header("refresh:2;url= ../screens/medewerker.php");
//             $_SESSION['rol'] = ' medewerker';
//             echo 'medewerker word ingelogd! je word doorverwezen';
//             exit;
//         } else {
//             // Medewerkercode is incorrect, toon een foutmelding
//             $foutmeldingMedewerker = "Ongeldige medewerkercode";
//         }
//     } else {
//         // Inloggen is mislukt, toon een foutmelding
//         $foutmeldingMedewerker = "Vul een medewerkercode in";
//     }
//check voor het wachtwoord
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Controleer of het geselecteerde balienummer is ingevuld
    if (!empty($_POST['balienummer'])) {
        $ingevoerdBalienummer = $_POST['balienummer'];

        // Query om het wachtwoord van de geselecteerde balie op te halen
        $query = "SELECT wachtwoord FROM Balie WHERE balienummer = :balienummer";
        $statement = $db->prepare($query);
        $statement->bindParam(':balienummer', $ingevoerdBalienummer);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Controleer of de balie is gevonden in de database
        if ($result) {
            $ingevoerdWachtwoord = $_POST['wachtwoord'];
            $correctWachtwoord = $result['wachtwoord'];

            // Controleer of het ingevoerde wachtwoord overeenkomt met het opgeslagen wachtwoord
            if (password_verify($ingevoerdWachtwoord, $correctWachtwoord)) {
                // Inloggen is gelukt, sla het balienummer op in de sessie
                $_SESSION['ingelogd'] = true;
                $_SESSION['balienummer'] = $ingevoerdBalienummer;
                $_SESSION['rol'] = 'medewerker';
                header("refresh:2;url=../screens/medewerker.php");
                echo 'Medewerker wordt ingelogd! Je wordt doorverwezen.';
                exit;
            } else {
                $foutmeldingMedewerker = "Ongeldig wachtwoord";
            }
        } else {
            $foutmeldingMedewerker = "Ongeldig balienummer";
        }
    } else {
        $foutmeldingMedewerker = "Selecteer een balienummer";
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
            $_SESSION['ingelogd'] = true;
            header("refresh:2;url= ../screens/passagier.php?id=$ingevoerdPassagiernummer");
            $_SESSION['rol'] = ' passagier';
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
                <select name="balienummer">
                        <?php
                // Query om de balienummers op te halen
                $query = "SELECT balienummer FROM Balie";
                $statement = $db->query($query);
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $balienummer = $row['balienummer'];
                    echo "<option value='$balienummer'>$balienummer</option>";
                }
                ?>
                </select>
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
