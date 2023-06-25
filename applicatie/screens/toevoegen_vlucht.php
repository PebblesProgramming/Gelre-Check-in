<?php
require_once '../starting/db_connectie.php';

// Maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();
$success = false;
// Controleer of het formulier voor het toevoegen van een vlucht is verzonden
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["vluchtnummer"])) {
    // Ontvang de ingevulde waarden
    $vluchtnummer = $_POST["vluchtnummer"];
    $bestemming = $_POST["bestemming"];
    $gatecode = $_POST["gatecode"];
    $max_aantal = $_POST["max_aantal"];
    $max_gewicht_pp = $_POST["max_gewicht_pp"];
    $max_totaalgewicht = $_POST["max_totaalgewicht"];
    $vertrektijd = $_POST["vertrektijd"];
    $maatschappijcode = $_POST["maatschappijcode"];

    try {
        // Converteer de vertrektijd naar het juiste databaseformaat
        $vertrektijdDatabase = date('Y-m-d H:i:s', strtotime($vertrektijd));

        // Voeg de vlucht toe aan de database
        $vluchtQuery = "INSERT INTO Vlucht (vluchtnummer, bestemming, gatecode, max_aantal, max_gewicht_pp, max_totaalgewicht, vertrektijd, maatschappijcode)
                        VALUES ('$vluchtnummer', '$bestemming', '$gatecode', '$max_aantal', '$max_gewicht_pp', '$max_totaalgewicht', '$vertrektijdDatabase', '$maatschappijcode')";

        // Voorbereiden van de query
        $statement = $db->prepare($vluchtQuery);
        // Uitvoeren van de query
        $statement->execute();

        // Succesmelding
        $success = true;
    } catch (PDOException $e) {
        // Foutmelding
        echo "Er is een fout opgetreden bij het toevoegen van de vlucht: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vluchten</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/vluchtenpagina.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> <!--custom font, might change later-->
</head>
<body>
    <div class="container">
        <?php include "../components/navbar.php" ?>
        <div class="container2">
            <div class="item">
                <h1> Vlucht toevoegen</h1>
                <form method="POST" action="">
                    <input type="number" name="vluchtnummer" placeholder="Vluchtnummer" required>
                    <input type="text" name="bestemming" placeholder="Bestemming" required>
                    <input type="text" name="gatecode" placeholder="Gatecode">
                    <input type="number" name="max_aantal" placeholder="Maximaal aantal" required>
                    <input type="number" step="0.01" name="max_gewicht_pp" placeholder="Maximaal gewicht per passagier" required>
                    <input type="number" step="0.01" name="max_totaalgewicht" placeholder="Maximaal totaalgewicht" required>
                    <input type="datetime-local" name="vertrektijd" placeholder="Vertrektijd">
                    <input type="text" name="maatschappijcode" placeholder="Maatschappijcode" required>
                    <input class="button" type="submit" value="Toevoegen">
                </form>
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
        </div>
    </div>
</body>
</html>
