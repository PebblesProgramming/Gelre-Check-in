<?php
function getPassengerData($passagiernummer , $db)
{

    $passagierQuery = "SELECT * FROM Passagier WHERE passagiernummer = :passagiernummer";
    $passagierStatement = $db->prepare($passagierQuery);
    $passagierStatement->bindParam(':passagiernummer', $passagiernummer);
    $passagierStatement->execute();
    $passagier = $passagierStatement->fetch(PDO::FETCH_ASSOC);

    return $passagier;
}
?>