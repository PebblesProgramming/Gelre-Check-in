

<?php

require_once '../app/filterInput_functie.php';
function voegVluchtToe($db){
    $success = false;
    // Controleer of het formulier voor het toevoegen van een vlucht is verzonden
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["vluchtnummer"])) {
        // Ontvang de ingevulde waarden
        $vluchtnummer = filterInput($_POST["vluchtnummer"]);
        $bestemming = filterInput($_POST["bestemming"]);
        $gatecode = filterInput($_POST["gatecode"]);
        $max_aantal = filterInput($_POST["max_aantal"]);
        $max_gewicht_pp = filterInput($_POST["max_gewicht_pp"]);
        $max_totaalgewicht = filterInput($_POST["max_totaalgewicht"]);
        $vertrektijd = filterInput($_POST["vertrektijd"]);
        $maatschappijcode = filterInput($_POST["maatschappijcode"]);
    
        // doe de juist database format voor de datum
        $vertrektijdDatabase = date('Y-m-d H:i:s', strtotime($vertrektijd));
    
        try {
            // Voeg de vlucht toe aan de database
            $vluchtQuery = "INSERT INTO Vlucht (vluchtnummer, bestemming, gatecode, max_aantal, max_gewicht_pp, max_totaalgewicht, vertrektijd, maatschappijcode)
                            VALUES ('$vluchtnummer', '$bestemming', '$gatecode', '$max_aantal', '$max_gewicht_pp', '$max_totaalgewicht', '$vertrektijdDatabase', '$maatschappijcode')";
            $statement = $db->prepare($vluchtQuery);
            $statement->execute();
            $success = true;
        } catch (PDOException $e) {
            echo "Er is een fout opgetreden bij het toevoegen van de vlucht: " . $e->getMessage();
        }
    }
?>
</div>
<?php if ($success) { ?>
<p>Succesvol toegevoegd!</p>
<p>Vluchtnummer: <?php echo $vluchtnummer; ?></p>
<p>Bestemming: <?php echo $bestemming; ?></p>
<p>Gatecode: <?php echo $gatecode; ?></p>
<p>Max aantal: <?php echo $max_aantal; ?></p>
<p>Max gewicht P.P.: <?php echo $max_gewicht_pp; ?></p>
<p>Max totaalgewicht: <?php echo $max_totaalgewicht; ?></p>
<p>Vertrektijd: <?php echo $vertrektijd; ?></p>
<p>Maatschappijcode: <?php echo $maatschappijcode; ?></p>
<?php } 
?>
<?php

}