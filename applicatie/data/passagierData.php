<?php
function getPassengerData($passagiernummer , $db)
{

    $passagierQuery = "SELECT passagiernummer, naam, vluchtnummer, geslacht, balienummer, stoel, inchecktijdstip FROM Passagier WHERE passagiernummer = :passagiernummer";
    $passagierStatement = $db->prepare($passagierQuery);
    $passagierStatement->bindParam(':passagiernummer', $passagiernummer);
    $passagierStatement->execute();
    $passagier = $passagierStatement->fetch(PDO::FETCH_ASSOC);

    return $passagier;
}
?>