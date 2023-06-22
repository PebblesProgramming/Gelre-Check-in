<?php
session_start();

// Maak de sessie leeg en vernietig deze
session_unset();
session_destroy();

// Stuur de gebruiker door naar de inlogpagina
header("Location: ../index.php");
exit();
?>
