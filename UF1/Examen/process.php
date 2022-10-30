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
     * Funcio per agafar el nom de l'usuari (correu) i el missatge de la connexió
     * depenent de la situació i crear un nou registre a connexions.json
     * 
     * @param string $usuari
     * @param string $missatge
     */
    function connexionsAJSON($usuari, $missatge){
        $dades_connexio = [
            array(
                "ip" => $_SERVER["REMOTE_ADDR"],
                "usuari" => $usuari,
                "data" => date("Y-m-d h:i:sa"),
                "estat" => $missatge
            )
        ];
        if (filesize("connexions.json") == 0) {
            $connexions_users = $dades_connexio;
        }else {
            $connexions_users = array_merge(llegeix("connexions.json"), $dades_connexio);
        }
        escriu($connexions_users, "connexions.json");
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
            if (filesize("users.json") == 0) {
                $dades = $dades_registre;
            }else {
                $dades = array_merge(llegeix("users.json"), $dades_registre);
            }
            //Fiquem l'array amb totes les dades al JSON
            escriu($dades, "users.json");
            //Creeum una nova connexio emb el missatge "nou-usuari"
            connexionsAJSON($_POST["email"], "nou-usuari");
            
            //Guardem les connexions en una variable de sessió per despres poder imprimir-les a hola.php
            $_SESSION["connexions"] = llegeix("connexions.json");
            //Agafem l'hora del moment per calcular 60 segons per guardar el log in
            $_SESSION["hora_login"] = time();

            //Redirigim a hola.php
            $_SESSION["nom"] = $_POST["nom"];
            $_SESSION["email"] = $_POST["email"];
            header("Location: hola.php");
        }else {
            //Creeum una nova connexio emb el missatge "creacio-fallida" i redirigim a index.php
            connexionsAJSON($_POST["email"], "creacio-fallida");
            $_SESSION["connexions"] = llegeix("connexions.json");
            header("Location: index.php?missatge_error=Creació fallida", true, 303);
        }
        
    }else {
        $email = false;
        $password = false;
        //Recorrem el JSON per veure si el correu i contrasenya existeixen i coincideixen
        foreach (llegeix("users.json") as $registre) {
            if ($_POST["email"] == $registre["email"]) {
                $email = true;
                if ($_POST["password"] == $registre["password"]) {
                    $password = true;
                }
                //Obtenim el nom de l'usuari agafant el nom del registre
                $nom = array_search($registre, llegeix("users.json"));
                break;
            }
        }
        if ($email && $password) {
            //Creeum una nova connexio emb el missatge "correcte"
            connexionsAJSON($_POST["email"], "correcte");
            $_SESSION["connexions"] = llegeix("connexions.json");
            $_SESSION["hora_login"] = time();

            //Redirigim a hola.php
            $_SESSION["nom"] = $nom;
            $_SESSION["email"] = $_POST["email"];
            header("Location: hola.php");
        }else {
            if (!$email) {
                //Creeum una nova connexio emb el missatge "usuari-incorrecte"
                connexionsAJSON($_POST["email"], "usuari-incorrecte");
                $_SESSION["connexions"] = llegeix("connexions.json");
            }else {
                //Creeum una nova connexio emb el missatge "contrasenya-incorrecte"
                connexionsAJSON($_POST["email"], "contrasenya-incorrecte");
                $_SESSION["connexions"] = llegeix("connexions.json");
            }
            //Si no està registrat l'usuari el tornem a index.php
            header("Location: index.php?missatge_error=Accés incorrecte", true, 303);
        }
    }
?>