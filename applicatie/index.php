<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelre-Check-In</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> <!--custom font, might change later-->
</head>
<body>
    <div class="container">
        <div class="navbar">
            <img src="images/actie.jpg" class="logo">
            <nav>
                <ul id="menuList">
                    <li><a href="">Home</a></li>
                    <li><a href="">CheckIn</a></li>
                    <li><a href="">Vluchten</a></li>
                    <li><a href="">Profiel</a></li>
                    <li><a href="">Uitloggen</a></li> <!-- uitloggen? -->
                </ul>
            </nav>
            <img src="images/adventure.jpg" class="menu-icon"> <!-- figure thi out without using js -->
        </div>

        <div class="row">
            <div class="col-1">
                <h2> Gelre Check In</h2>
                <h3> Nu Inchecker</h3>
                <p>Overal te doen</p>
                <h4>$3400</h4>
                <button type="button">Boek Nu</button>
            </div>
            <div class="col-2">
                <img src="images/GelreCheckIn.jpg" class="checkin">
                <div class="color-box"></div> <!-- Awesome background effect, look for better photo -->
                <div class="add-btn"> <!-- try and find an awesome implimintation for this -->
                    <img src="images/drama.jpg">
                    <p>Meer acties</p>
                </div>
            </div>
        </div>

        <div class="social-links"> <!--change these to socials -->
            <img src="images/crime.jpg">
            <img src="images/crime.jpg">
            <img src="images/crime.jpg">
        </div>
    </div>
</body>

<?php include_once "components/footer.php" ?>
</html>
