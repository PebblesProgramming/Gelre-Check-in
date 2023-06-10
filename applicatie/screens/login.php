<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <!--<link rel="stylesheet" href="/css/style.css">-->
    <link rel="stylesheet" href="../css/login-register.css">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'> <!--custom font, might change later-->
</head>
<body>
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>
                <form action="#">
                    <div class="input-field">
                        <input type="text" placeholder="Vul je email in" required>                  
                    </div>
                    <div class="input-field">
                        <input type="password" placeholder="Vul je wachtwoord in" required>                  
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck"class="text">Onthoud mij</label>
                        </div>

                        <a href="#" class="text"> Wachtwoord vergeten?</a>
                        </div>

                        <div class="input-field button">
                            <a href="../index.php"><input type="button" value="Log in">
                        </div>

                        </form>

                    <div class="login-signup">
                        <span class="text">Nog geen klant?
                            <a href="../screens/register.php" class="text signup-text">Registreer nu!</a>
                        </span>
                    </div>

                    </div>
                
            </div>
        </div>
    </div>
</body>

</html>