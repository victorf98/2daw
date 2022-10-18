<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Exemple de formulari</title>

</head>

<body>
    <?php
        session_start();
        if (isset($_SESSION["marca"])) {
            echo $_SESSION["marca"] . "<br>";
            echo $_SESSION["color"];
            header("Location: P3.php");
        }else {
            echo "Fi";
        }
        //setcookie("laMevaCookie", $_COOKIE["laMevaCookie"]);
        
    ?>

</body>
</html>