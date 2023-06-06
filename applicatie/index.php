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
            <img src="favicon.ico" class="logo"> 
            <h4>Welkom insgebruiker </h4>
            <nav>
                <ul id="menuList">
                    <li><input type="text" placeholder="Zoek vlucht..."></li>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="screens/vluchten.php">Vluchten</a></li>
                    <li><a href="screens/inchecken.php">Inchecken</a></li>
                    <li><a href="screens/profile.php">Profiel</a></li>
                    <li><a href="">Uitloggen</a></li> <!-- uitloggen? -->
                </ul>
            </nav>
            <img src="images/menu.png" class="menu-icon"> <!-- figure thi out without using js -->
        </div>

        <div class="row">
            <div class="col-1">
                <h2> Gelre Check In</h2>
                <h3> Wilt u goed aan de vakantie beginnen?</h3>
                <p>Check nu in!</p>
                <h4>max €90 extra!</h4>
                <button type="button">Check In</button>
            </div>
            <div class="col-2">
                <img src="images/checkin.png" class="checkin">
                <div class="color-box"></div> <!-- Awesome background effect, look for better photo -->
                <div class="add-btn"> <!-- try and find an awesome implimintation for this -->
                    <img src="images/add.png">
                    <p>Check In!</p> <!-- add flights for employee UI-->
                </div>
            </div>
        </div>
        
        
         <h1 class="h1flights">Bekijk Vluchten</h1> 
         <button type="button" class="buttonFlights">Bekijk alles</button> 
            <br>
            <br>
            <br>
        <div class="wrapper">
            <div class="item">box-1</div>
            <div class="item">box-2</div>
            <div class="item">box-3</div>
            <div class="item">box-4</div>
            <div class="item">box-5</div>
            <div class="item">box-6</div>
            <div class="item">box-7</div>
            <div class="item">box-8</div>
            <div class="item">box-9</div>
            <div class="item">box-10</div>
            <div class="item">box-11</div>
            <div class="item">box-12</div>
        </div>
    

        
        

        <div class="social-links"> <!--change these to socials -->
            <img src="images/fb.png">
            <img src="images/ig.png">
            <img src="images/tw.png">
        </div>
    </div>
</body>

<?php include_once "components/footer.php" ?>
</html>
