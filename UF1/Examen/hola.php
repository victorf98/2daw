<?php
    session_start();
    //Si no hi ha una hora de login vol dir que no tenim un login guardat i ja ens porta a index.php
    if (!isset($_SESSION["hora_login"])) {
        header("Location: index.php");
    }else {
        //Si hi ha un login guardat calculem que si porta més de 60 segons ens porta a index.php
        if (time() - $_SESSION["hora_login"] > 60) {
            header("Location: index.php");
        }
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Benvingut</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">

</head>
<body>
<div class="container noheight" id="container">
    <div class="welcome-container">
        <h1>Benvingut!</h1>
        <div>Hola 
            <?php 
                if (isset($_SESSION["nom"])) {
                    echo $_SESSION["nom"];
                } else {
                    echo "unknown";
                }
                ?>
            , les teves darreres connexions són:</div>
            <!--Enviarem per POST un paràmetre "logout" si volem tancar sessió-->
        <form action="index.php?logout" method="post">
            <button>Tanca la sessió</button>
        </form>
    </div>
</div>
</body>
</html>
<?php
    }
?>