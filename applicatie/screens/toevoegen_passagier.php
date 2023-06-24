

<!DOCTYPE html>
<?php
require_once '../starting/db_connectie.php';
// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();
$success = false;
// Controleer of het formulier voor het toevoegen van een passagier is verzonden
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["passagiernummer"])) {
    // Ontvang de ingevulde waarden
    $passagiernummer = $_POST["passagiernummer"];
    $naam = $_POST["naam"];
    $vluchtnummer = $_POST["vluchtnummer"];
    $geslacht = $_POST["geslacht"];
    $balienummer = $_POST["balienummer"];
    $stoel = $_POST["stoel"];
    $inchecktijdstip = $_POST["inchecktijdstip"];

    // Voeg de passagier toe aan de database
    $passagierQuery = "INSERT INTO Passagier (passagiernummer, naam, vluchtnummer, geslacht, balienummer, stoel, inchecktijdstip)
                    VALUES ('$passagiernummer', '$naam', '$vluchtnummer', '$geslacht', '$balienummer', '$stoel', '$inchecktijdstip')";
    $db->query($passagierQuery);
    //was succesvol
    $success = true;
}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelre-Check-In</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/vluchtenpagina.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> <!--custom font, might change later-->
</head>
<body>
    <div class="container">
    <?php include "../components/navbar.php" ?>
        <div class="container2">
        <div class="item">
                <h1> Passagier toevoegen</h1>
                <form method="POST" action="">
                    <input type="number" name="passagiernummer" placeholder="Passagiernummer" required>
                    <input type="text" name="naam" placeholder="Naam" required>
                    <input type="number" name="vluchtnummer" placeholder="Vluchtnummer" required>
                    <input type="text" name="geslacht" placeholder="Geslacht">
                    <input type="number" name="balienummer" placeholder="Balienummer">
                    <input type="text" name="stoel" placeholder="Stoel">
                    <input type="datetime-local" name="inchecktijdstip" placeholder="Inchecktijdstip">
                    <input class="button" type="submit" value="Toevoegen">
                </form>
            </div>
            <?php if ($success) { ?>
            <p>Succesvol toegevoegd!</p>
            <p>Passagiernummer: <?php echo $passagiernummer; ?></p>
            <p>Naam: <?php echo $naam; ?></p>
            <p>Vluchtnummer: <?php echo $vluchtnummer; ?></p>
            <p>Geslacht: <?php echo $geslacht; ?></p>
            <p>Balienummer: <?php echo $balienummer; ?></p>
            <p>Stoel: <?php echo $stoel; ?></p>
            <p>Inchecktijdstip: <?php echo $inchecktijdstip; ?></p>
            <?php } else{
            echo 'Het toevoegen is fout gegaan';
            }
            ?>
        </div>
    </div>
</body>
</html>

<