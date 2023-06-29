        <?php
require_once '../check-session.php';
require_once '../db_connectie.php';
require_once '../app/filterInput_functie.php';
// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();

if (isset($_GET['search'])) {
  
    $zoekterm = filterInput($_GET['search']);
    header("Location: vluchtinfo.php?vluchtnummer=" . urlencode($zoekterm));
    exit();
}
?>
<link rel="stylesheet" href="../css/style.css'>">
<div class="navbar">
<img src="../favicon.ico" class="logo" alt=""> 
<nav>
<?php
            // Controleer of de sessievariabele voor de rol is ingesteld
            if (isset($_SESSION['rol'])) {
                // Haal de rol op uit de sessievariabele
                $rol = $_SESSION['rol'];
                // Pas de links aan op basis van de rol
                if ($rol === 'medewerker') {
                    // Toon de links voor medewerkers
                    ?>            
            <ul>
            <li>
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Zoek vluchtnummer...">
                <button type="submit">Zoeken</button>
            </form></li>
                <li><a href="medewerker.php">Dashboard</a></li>
                <li><a href="vluchten.php">Vluchten</a></li>
                <li class="dropdown">
                <a href="#" class="dropbtn">Toevoegen</a>
                <div class="dropdown-content">
                    <a href="toevoegen_passagier.php">Passagier</a>
                    <a href="toevoegen_vlucht.php">Vlucht</a>
                </div>
            </li>
                <li><a href="logout.php">Uitloggen</a></li>
            </ul>
            </nav>
            
                    <?php
                } elseif ($rol === 'passagier') {
                    // Toon de links voor passagiers
                    ?>
                 <nav>
                    <ul>
                        <li><a href="passagier.php">Dashboard</a></li>
                        <li><a href="boekingen.php">Mijn Boekingen & Gegevens</a></li>
                        <li><a href="vluchten.php">Vluchten</a></li>
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
            <img src="../images/menu.png" class="menu-icon" alt="">
        </div>


