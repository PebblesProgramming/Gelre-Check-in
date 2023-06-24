
<?php
// Controleer of de medewerker is ingelogd, anders doorsturen naar de inlogpagina
       session_start(); //de sessie check word hier neergezet omdat de navbar overal word gebruikt

       require_once '../starting/toegangscontrole.php';

       if (!isset($_SESSION['ingelogd']) || $_SESSION['ingelogd'] !== true) {
       header('refresh:2;url= ../index.php');
       echo'U moet eerst inloggen voordat u bij deze paginas kan!' ;
       exit;
       }

// Controleer de autorisatie op basis van de gebruikersrol
$toegestaneRollen = array(
       'passagier.php' => array('passagier'), 
       'boekingen.php' => array('passagier'),
       'uitloggen.php' => array('medewerker', 'passagier'), 
       'medewerker.php'=> array('medewerker'),
       'passagiers_medewerker.php'=>array('medewerker'),
       'vluchten.php'=>array('medewerker' , 'passagier'),
       'toevoegen_medewerker.php'=>array('medewerker')
   );
   
   $currentPagina = basename($_SERVER['PHP_SELF']); // dit is de pagina waar een user zich op dat moment bevind
   
   if (array_key_exists($currentPagina, $toegestaneRollen)) {
       $toegestaneRollenVoorPagina = $toegestaneRollen[$currentPagina];
       $gebruikerRol = $_SESSION['rol'];
   
       if (!in_array($gebruikerRol, $toegestaneRollenVoorPagina)) {
           header('refresh:2;url= ../index.php');
           echo 'je hebt geen toegang tot deze pagina met uw rol';
           exit;
       }
   }

?>