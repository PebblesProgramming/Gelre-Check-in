<?php
// Functie om het wachtwoord van de geselecteerde balie op te halen
function getWachtwoord($db, $balienummer) {
    $query = "SELECT wachtwoord, balienummer FROM Balie WHERE balienummer = :balienummer";
    $statement = $db->prepare($query);
    $statement->bindParam(':balienummer', $balienummer);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result['wachtwoord'];
    } else {
        return false;
    }
}

// Functie om de passagiergegevens op te halen op basis van het ingevoerde passagiernummer
function getPassagier($db, $passagiernummer) {
    $query = "SELECT passagiernummer FROM Passagier WHERE passagiernummer = :passagiernummer";
    $statement = $db->prepare($query);
    $statement->bindParam(':passagiernummer', $passagiernummer);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return true;
    } else {
        return false;
    }
}
?>
