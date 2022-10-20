<?php
/**
 * Comprovem si la paraula està a la llista de solucions
 * En cas contrari tornarà algún missatge d'error.
 * També fem que si es passa una paraula buida no mostri cap error.
 */
    session_start();
    if ($_GET["paraula"] == null) {
        $_SESSION["missatge_error"] = "";
    }elseif (!str_contains($_GET["paraula"], $_SESSION["lletres"][3])){
        $_SESSION["missatge_error"] = "Falta la lletra del mig!";
    }else{
        if (!in_array($_GET["paraula"], $_SESSION["funcions_trobades"])){
            if (in_array($_GET["paraula"], $_SESSION["funcions"])) {
                array_push($_SESSION["funcions_trobades"], $_GET["paraula"]);
                $_SESSION["missatge_error"] = "";
            }else {
                $_SESSION["missatge_error"] = "Aquesta funció no existeix!";
            }
        }else {
            $_SESSION["missatge_error"] = "Aquesta paraula ja hi és!";
        }
    }
    if (isset($_GET["data"])) {
        header("Location: index.php?data=" . $_GET["data"]);
    }else{
        header("Location: index.php");
    }
?>