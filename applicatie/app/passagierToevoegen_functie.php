<?php
function voegPassagierToe($db)
{
    $success = false;
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["passagiernummer"])) {
        $passagiernummer = filterInput($_POST["passagiernummer"]);
        $naam = filterInput($_POST["naam"]);
        $vluchtnummer = filterInput($_POST["vluchtnummer"]);
        $geslacht = filterInput($_POST["geslacht"]);
        $balienummer = filterinput($_POST["balienummer"]);
        $stoel = filterInput($_POST["stoel"]);
        $inchecktijdstip = filterInput($_POST["inchecktijdstip"]);
        $inchecktijdstipDatabase = date('Y-m-d H:i:s', strtotime($inchecktijdstip));
    
        try {
            $passagierQuery = "INSERT INTO Passagier (passagiernummer, naam, vluchtnummer, geslacht, balienummer, stoel, inchecktijdstip)
                              VALUES ('$passagiernummer', '$naam', '$vluchtnummer', '$geslacht', '$balienummer', '$stoel', '$inchecktijdstipDatabase')";
            $statement = $db->prepare($passagierQuery);               
            $statement->execute();
            $success = true;
        } catch (PDOException $e) {
            $success = false;
            echo "<br> Een van de ingevulde velden is al in gebruik! Controleer de database.";
        }
    }
    if ($success) { ?>
        <p>Succesvol toegevoegd!</p>
        <p>Passagiernummer: <?php echo $passagiernummer; ?></p>
        <p>Naam: <?php echo $naam; ?></p>
        <p>Vluchtnummer: <?php echo $vluchtnummer; ?></p>
        <p>Geslacht: <?php echo $geslacht; ?></p>
        <p>Balienummer: <?php echo $balienummer; ?></p>
        <p>Stoel: <?php echo $stoel; ?></p>
        <p>Inchecktijdstip: <?php echo $inchecktijdstip; ?></p>
    <?php } 
}

