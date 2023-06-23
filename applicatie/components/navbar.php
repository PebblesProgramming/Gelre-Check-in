        <?php
require_once '../starting/check-session.php';
require_once '../starting/db_connectie.php';

// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();

// Controleer of er een zoekopdracht is ingediend
if (isset($_GET['search'])) {
    // Haal de ingediende zoekopdracht op
    $zoekterm = $_GET['search'];

    // Valideer en verwerk de zoekterm (bijv. controleren op speciale tekens, SQL-injectie voorkomen)

    // Stuur de gebruiker door naar vluchtinfo.php met het vluchtnummer als parameter
    header("Location: vluchtinfo.php?vluchtnummer=" . urlencode($zoekterm));
    exit(); // Zorg ervoor dat het verdere script niet wordt uitgevoerd na het doorsturen
}
?>

<link rel="stylesheet" href="css/style.css">
<div class="navbar">
            <img src="../favicon.ico" class="logo"> 
            <h4>Welkom! </h4>
            <nav>
            <?php

            // Controleer of de sessievariabele voor de rol is ingesteld
            if (isset($_SESSION['rol'])) {
                // Haal de rol op uit de sessievariabele
                $rol = $_SESSION['rol'];

                // Pas de links aan op basis van de rol
                if ($rol === ' medewerker') {
                    // Toon de links voor medewerkers
                    ?>
                    <ul>
                    <li>
                    <form action="" method="GET">
                        <input type="text" name="search" placeholder="Zoek vluchtnummer...">
                        <button type="submit">Zoeken</button>
                    </form></li>
                        <li><a href="medewerker.php">Dashboard</a></li>
                        <li><a href="passagiers.php">Passagiers</a></li>
                        <li><a href="vluchten.php">Vluchten</a></li>
                        <li><a href="logout.php">Uitloggen</a></li>
                    </ul>
                    <?php
                } elseif ($rol === ' passagier') {
                    // Toon de links voor passagiers
                    ?>
                    <ul>
                        <li><a href="passagier.php">Dashboard</a></li>
                        <li><a href="boekingen.php">Mijn Boekingen & Gegevens</a></li>
                        <li><a href="logout.php">Uitloggen</a></li>
                    </ul>
                    <?php
                } else {
                    echo'ongeldige rol probeer opnieuw';
                    header('Location: ../index.php');
                }
            } else {
                echo'Rol is niet ingesteld probeer opnieuw';
                header('Location: ../index.php');
            }
            ?>
            </nav>
            <img src="../images/menu.png" class="menu-icon"> <!-- figure thi out without using js -->
        </div>


