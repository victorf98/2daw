<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Exemple de formulari</title>

</head>

<body>

        <?php
                session_start();
                $_SESSION["marca"] = "iPhone";
                $_SESSION["color"] = "Negre";
                /*if (isset($_COOKIE["laMevaCookie"])) {
                        setcookie("laMevaCookie", 101, 0);
                }else {
                        setcookie("laMevaCookie", 100, 0);
                }*/
                header("Location: P2.php");
        ?>
	
<!--
//Processar les dades
        echo "<h3>Dades processades </h3>";
        echo "<pre>";
        print_r($_GET);
        echo "</pre>";*/
-->


</body>
</html>