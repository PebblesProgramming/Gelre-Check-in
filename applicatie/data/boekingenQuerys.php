<?php
function getPassagierGegevens($passagiernummer,$db ) {
    $query = "SELECT P.naam AS passagier_naam, V.vluchtnummer, V.max_gewicht_pp, V.vertrektijd, V.bestemming, G.gatecode, L.naam AS luchthaven_naam, B.objectvolgnummer, B.gewicht, IB.balienummer AS inchecken_balienummer
              FROM Passagier AS P
              JOIN Vlucht AS V ON P.vluchtnummer = V.vluchtnummer
              LEFT JOIN Gate AS G ON V.gatecode = G.gatecode
              JOIN Luchthaven AS L ON V.bestemming = L.luchthavencode
              LEFT JOIN BagageObject AS B ON P.passagiernummer = B.passagiernummer
              LEFT JOIN IncheckenBestemming AS IB ON L.luchthavencode = IB.luchthavencode
              WHERE P.passagiernummer = :passagiernummer";

    $statement = $db->prepare($query);
    $statement->bindParam(':passagiernummer', $passagiernummer);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function getBagage($passagiernummer,$db ) {
    $bagageQuery = "SELECT passagiernummer, objectvolgnummer, gewicht FROM BagageObject WHERE passagiernummer = :passagiernummer";
    $statement = $db->prepare($bagageQuery);
    $statement->bindParam(':passagiernummer', $passagiernummer);
    $statement->execute();
    $bagageResult = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $bagageResult;
}

function voegBagageToe($passagiernummer, $objectvolgnummer, $gewicht,$db) {
    $passagiernummer = $_POST['passagiernummer'];
    $gewicht = $_POST['gewicht'];
    $query = "SELECT MAX(objectvolgnummer) AS max_objectvolgnummer FROM BagageObject WHERE passagiernummer = :passagiernummer";
    $statement = $db->prepare($query);
    $statement->bindParam(':passagiernummer', $passagiernummer);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    // als dit het eerste object is word het 0 anders word het 1
    $objectvolgnummer = $result['max_objectvolgnummer'] !== null ? $result['max_objectvolgnummer'] + 1 : 0;
    // Haal het totale gewicht van de bagage van de passagier op
    $query = "SELECT SUM(gewicht) AS totaal_gewicht FROM BagageObject WHERE passagiernummer = :passagiernummer";
    $statement = $db->prepare($query);
    $statement->bindParam(':passagiernummer', $passagiernummer);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //als er nog geen totaalgewicht is, wordt het huidige gewicht als het totaalgewicht gebruikt. anders wordt het op het bestaande opgeteld
    $totaal_gewicht = $result['totaal_gewicht'] !== null ? $result['totaal_gewicht'] + $gewicht : $gewicht;

    // Haal het maximale gewicht per persoon op uit de Vlucht-tabel
    $vluchtnummer = getPassagierGegevens($passagiernummer,$db)['vluchtnummer'];
    $query = "SELECT max_gewicht_pp FROM Vlucht WHERE vluchtnummer = :vluchtnummer";
    $statement = $db->prepare($query);
    $statement->bindParam(':vluchtnummer', $vluchtnummer); // Zorg ervoor dat je het vluchtnummer hebt, zodat je het kunt binden aan de parameter
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $max_gewicht_pp = $result['max_gewicht_pp'] ?? 0;
    
    // Controleer of het totale gewicht per persoon het maximale gewicht overschrijdt
    if ($totaal_gewicht> $max_gewicht_pp) {
        return "Fout: Het totale gewicht per persoon overschrijdt het maximale gewicht toegestaan voor deze vlucht.";
    }

    // Bereid de SQL-query voor
    $query = "INSERT INTO BagageObject (passagiernummer, objectvolgnummer, gewicht)
              VALUES (:passagiernummer, :objectvolgnummer, :gewicht)";

    // Maak een prepared statement
    $statement = $db->prepare($query);

    // Bind de waarden aan de parameters
    $statement->bindParam(':passagiernummer', $passagiernummer);
    $statement->bindParam(':objectvolgnummer', $objectvolgnummer);
    $statement->bindParam(':gewicht', $gewicht);

    // Voer de query uit
    if ($statement->execute()) {
        return "Bagage is succesvol toegevoegd.";
    } else {
        return "Er is een fout opgetreden bij het toevoegen van de bagage.";
    }
}