
<?php
// Controleer of de medewerker is ingelogd, anders doorsturen naar de inlogpagina
       session_start(); //de sessie check word hier neergezet omdat de navbar overal word gebruikt
if (!isset($_SESSION['ingelogd']) || $_SESSION['ingelogd'] !== true) {
header('refresh:2;url= ../index.php');
echo'U moet eerst inloggen voordat u bij deze paginas kan!' ;
exit;
}

?>