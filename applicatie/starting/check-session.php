
<?php

       session_start(); 

       require_once '../starting/toegangscontrole.php';

       if (!isset($_SESSION['ingelogd']) || $_SESSION['ingelogd'] !== true) {
       header('refresh:2;url= ../index.php');
       echo'U moet eerst inloggen voordat u bij deze paginas kan!' ;
       exit;
       }

//controleer rol en acces
$toegestaneRollen = array(
       'passagier.php' => array('passagier'), 
       'boekingen.php' => array('passagier', 'medewerker'),
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