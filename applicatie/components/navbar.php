

<link rel="stylesheet" href="css/style.css">
<div class="navbar">
            <img src="../favicon.ico" class="logo"> 
            <h4>Welkom insgebruiker </h4>
            <nav>
                <ul id="menuList">
                    <li><input type="text" placeholder="Zoek vluchtnummer..."></li>
                    <li><a href="../screens/medewerker.php">Home</a></li>
                    <li><a href="../vluchten.php">Vluchten</a></li>
                    <li><a href="../screens/logout.php">Uitloggen</a></li> <!-- uitloggen? -->
                </ul>
            </nav>
            <img src="../images/menu.png" class="menu-icon"> <!-- figure thi out without using js -->
        </div>

        <?php
      session_start(); //de sessie check word hier neergezet omdat de navbar overal word gebruikt
                        // miss in de db connectie zetten?
    //                     // weet niet of dat handig is
    //   if (!isset($_SESSION['ingelogd']) || $_SESSION['ingelogd'] !== true) {
    //       //header('Location: ../index.php');
    //       exit;
//}

// // Vernietig de sessie
// session_destroy();

// // Stuur de gebruiker door naar de gewenste bestemming
// header("Location: ../index.php");
// exit();
?>