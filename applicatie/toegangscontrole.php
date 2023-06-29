<?php
function controleerToegang($pagina)
{
    global $toegestaneRollen;

    //controleer of de pagina in de toegestane rollen array bestaat
    if (array_key_exists($pagina, $toegestaneRollen)) {
        $vereisteRollen = $toegestaneRollen[$pagina];
        if (!in_array($_SESSION['rol'], $vereisteRollen)) {
            header("Location: foutpagina.php");
            exit;
        }
    }
}

?>
