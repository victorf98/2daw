<?php
session_start();
    /**
     * Llegeix les dades del fitxer. Si el document no existeix torna un array buit.
     *
     * @param string $file
     * @return array
     */
    function llegeix(string $file) : array
    {
        $var = [];
        if ( file_exists($file) ) {
            $var = json_decode(file_get_contents($file), true);
        }
        return $var;
    }

    /**
     * Guarda les dades a un fitxer
     *
     * @param array $dades
     * @param string $file
     */
    function escriu(array $dades, string $file): void
    {
        file_put_contents($file,json_encode($dades, JSON_PRETTY_PRINT));
    }

    /**
     * Si rebem el POST "nom" vol dir que és un registre i procedirem a 
     * registrar l'usuari
     */
    if (isset($_POST["nom"])) {
        //Si l'usuari no està al JSON el registrarem
        if (!isset(llegeix("users.json")[$_POST["nom"]])) {
            //Creem una array amb les dades noves
            $dades_registre = [
                $_POST["nom"] => array(
                    "email" => $_POST["email"],
                    "password" => $_POST["password"]
                )
            ];
            //Unim les dades del JSON amb les noves en una array
            $dades = array_merge(llegeix("users.json"), $dades_registre);
            //Fiquem l'array amb totes les dades al JSON
            escriu($dades, "users.json");
            $_SESSION["hora_login"] = time();
            //Redirigim a hola.php
            $_SESSION["nom"] = $_POST["nom"];
            header("Location: hola.php?");
        }else {
            header("Location: index.php");
        }
        
    }else {
        $credencials = false;
        //Recorrem el JSON per veure si el correu i contrasenya existeixen i coincideixen
        foreach (llegeix("users.json") as $registre) {
            if ($_POST["email"] == $registre["email"] && $_POST["password"] == $registre["password"]) {
                $credencials = true;
                //Obtenim el nom de l'usuari agafant el nom del registre
                $nom = array_search($registre, llegeix("users.json"));
                break;
            }
        }
        if ($credencials) {
            $_SESSION["hora_login"] = time();
            //Redirigim a hola.php
            $_SESSION["nom"] = $nom;
            header("Location: hola.php");
        }else {
            //Si no està registrat l'usuari el tornem a index.php
            header("Location: index.php");
        }
    }
?>