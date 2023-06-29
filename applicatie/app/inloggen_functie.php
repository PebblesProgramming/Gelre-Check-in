<?php
// Functie voor het inloggen van de medewerker

// global $foutmeldingMedewerker;
// global $foutmeldingPassagier;
function medewerkerInloggen() {
    require_once '../applicatie/db_connectie.php';
    require_once '../applicatie/data/inloggen_query.php';

    $db = maakVerbinding();
    $foutmeldingMedewerker= '';
    // Controleer of het ingevoerde balienummer en wachtwoord niet leeg zijn
    if (!empty($_POST['balienummer']) && !empty($_POST['wachtwoord'])) {
        $ingevoerdBalienummer = $_POST['balienummer'];
        $ingevoerdWachtwoord = $_POST['wachtwoord'];

        // Haal het wachtwoord op van de geselecteerde balie
        $correctWachtwoord = getWachtwoord($db, $ingevoerdBalienummer);
        $correctWachtwoord = password_hash($correctWachtwoord, PASSWORD_DEFAULT);

        if ($correctWachtwoord) {
            // Controleer of het ingevoerde wachtwoord overeenkomt met het gehashte wachtwoord
            if (password_verify($ingevoerdWachtwoord, $correctWachtwoord)) {
                // Inloggen is gelukt, sla het balienummer op in de sessie
                $_SESSION['ingelogd'] = true;
                $_SESSION['balienummer'] = $ingevoerdBalienummer;
                $_SESSION['rol'] = 'medewerker';
                header("refresh:2;url=../public/medewerker.php");
                echo 'Medewerker wordt ingelogd! Je wordt doorverwezen.';
                exit;
            } else {
                echo "<p>" .  $foutmeldingMedewerker = "Ongeldig wachtwoord". "</p>";
            }
        } else {
            echo "<p>" .  $foutmeldingMedewerker = "Ongeldig balienummer". "</p>";
        }
    } else {
        echo "<p>" . $foutmeldingMedewerker = "Vul een balienummer en wachtwoord in". "</p>";
    }
}

// Functie voor het inloggen van de passagier
function passagierInloggen() {
    require_once '../applicatie/db_connectie.php';
    require_once '../applicatie/data/inloggen_query.php';

    $db = maakVerbinding();
    $foutmeldingPassagier = '';
    // Controleer of het passagiernummer is ingevuld
    if (!empty($_POST['passagiernummer'])) {
        $ingevoerdPassagiernummer = $_POST['passagiernummer'];

        $ingevoerdPassagiernummer = htmlspecialchars($ingevoerdPassagiernummer);

        // Controleer of de passagier bestaat
        if (getPassagier($db, $ingevoerdPassagiernummer)) {
            // Inloggen is gelukt, sla het passagiernummer op in de sessie
            header("refresh:2;url=../public/passagier.php?id=$ingevoerdPassagiernummer");
            $_SESSION['ingelogd'] = true;
            $_SESSION['rol'] = 'passagier';
            $_SESSION['passagierid'] = $ingevoerdPassagiernummer;
            echo 'Passagier wordt ingelogd! Je wordt doorverwezen.';
            exit;
        } else {
            // Inloggen is mislukt, toon een foutmelding
            echo "<p>" . $foutmeldingPassagier = "Ongeldig passagiernummer". "</p>";
        }
    } else {
        // Inloggen is mislukt, toon een foutmelding
        echo "<p>" .$foutmeldingPassagier = "Vul een passagiernummer in". "</p>";
    }
    
}
?>
