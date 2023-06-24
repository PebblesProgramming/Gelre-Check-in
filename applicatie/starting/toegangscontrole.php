<?php

// Functie om te controleren of de gebruiker de juiste rol heeft voor een bepaalde pagina
function controleerToegang($pagina)
{
    global $toegestaneRollen;

    // Controleer of de pagina in de toegestane rollen array bestaat
    if (array_key_exists($pagina, $toegestaneRollen)) {
        // Haal de vereiste rollen voor de pagina op
        $vereisteRollen = $toegestaneRollen[$pagina];

        // Controleer of de ingelogde gebruiker de juiste rol heeft
        if (!in_array($_SESSION['rol'], $vereisteRollen)) {
            // Gebruiker heeft geen toegang tot de pagina, doorsturen naar een foutpagina
            header("Location: foutpagina.php");
            exit;
        }
    }
}

?>
