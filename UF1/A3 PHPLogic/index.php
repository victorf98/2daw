<?php session_start();
        /**
         * Quan fem un POST ens redirigirà a process.php, hi passarem la paraula per POST
         *  i comprovarem si la paraula és correcte
         */
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (isset($_SESSION["copia_data"])) {
                //Si hi ha una data passada per GET tindrem la variable "copia_data" i la passarem per POST
                header("Location: process.php?paraula=" . $_POST["paraula"] . "&data=" . $_SESSION["copia_data"]);
            }else{
                header("Location: process.php?paraula=" . $_POST["paraula"]);
            }      
        }else {
            include "joc_de_lletres.php";
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                
                //Si no tenim cap joc de lletres en crearem un amb la data actual o amb la passada per GET
                if (!isset($_SESSION["lletres"])){
                    if (!isset($_GET["data"]) || $_GET["data"] == null) {
                        $_SESSION["data"] = date("Y-m-d");
                        $_SESSION["copia_data"] = null;
                        $_SESSION["sol"] = 0;
                        $_SESSION["paraules_trobades"] = 0;
                        $_SESSION["funcions_trobades"] = array();
                        $_SESSION["missatge_error"] = "";
                        canviarLletres(date("Y-m-d"));
                    }else{
                        $_SESSION["data"] = $_GET["data"];
                        $_SESSION["copia_data"] = $_GET["data"];
                        $_SESSION["sol"] = 0;
                        $_SESSION["paraules_trobades"] = 0;
                        $_SESSION["funcions_trobades"] = array();
                        $_SESSION["missatge_error"] = "";
                        canviarLletres($_GET["data"]);
                    }
                }else{

                    /**
                     * Si ja tenim un joc de lletres però passem de tenir un GET de data 
                     * a no tenir-lo i viceversa tornarem a fer un joc de lletres 
                     */
                    if((!isset($_GET["data"]) || $_GET["data"] == null) && date("Y-m-d") != $_SESSION["data"]) {
                        $_SESSION["data"] = date("Y-m-d");
                        $_SESSION["copia_data"] = null;
                        $_SESSION["sol"] = 0;
                        $_SESSION["paraules_trobades"] = 0;
                        $_SESSION["funcions_trobades"] = array();
                        $_SESSION["missatge_error"] = "";
                        canviarLletres(date("Y-m-d"));
                    }elseif(isset($_GET["data"])){
                        if ($_GET["data"] != null && $_GET["data"] != $_SESSION["data"]) {
                            $_SESSION["data"] = $_GET["data"];
                            $_SESSION["copia_data"] = $_GET["data"];
                            $_SESSION["sol"] = 0;
                            $_SESSION["paraules_trobades"] = 0;
                            $_SESSION["funcions_trobades"] = array();
                            $_SESSION["missatge_error"] = "";
                            canviarLletres($_GET["data"]);
                        } 
                    }   
                }
                
                //Quan fem un GET de neteja netejarem les funcions trobades, treurem les sol·lucions i buidarem el missatge d'error
                if (isset($_GET["neteja"])) {
                    $_SESSION["funcions_trobades"] = array();
                    $_SESSION["paraules_trobades"] = 0;
                    $_SESSION["sol"] = 0;
                    $_SESSION["missatge_error"] = "";
                }
            }
        ?>
<!DOCTYPE html>

<html lang="ca">
<head>
    <title>PHPLògic</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Juga al PHPògic.">
    <link href="//fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body data-joc=<?php echo $_SESSION["data"]?>>
    <?php  
            $_SESSION["paraules_trobades"] = count($_SESSION["funcions_trobades"]);
                
    ?>
    <p><?php
    /**
     * Imprimirem totes les sol·lucions, es mostraran si hi ha un GET de "sol" 
     * o quan aquesta variable sigui -1. Així quan es fa el GET de "sol" es posa la
     * variable a -1 perquè es segueixin mostrant fins que es netegi o es tingui una altra combinació
     * de lletes
     */
    if (isset($_GET["sol"]) || $_SESSION["sol"] == -1) {
                    $_SESSION["sol"] = -1;
                    $n = 1;
                    echo "SOLUCIONS: ";
                    foreach ($_SESSION["funcions"] as $funcio) {
                        echo $n . ". " . $funcio . " ";
                        $n += 1;
                    }
                }?></p>
    <p><?php echo $_SESSION["carrega"] ?></p>
    <form method="post" id="myform" name="myform">
        <div class="main">
            <h1>
                <a href=""><img src="logo.png" height="54" class="logo" alt="PHPlògic"></a>
            </h1>

            <?php 
            /**
             * Si hi ha un missatge d'error fet apareixerà,
             * sino no apareix res
             */
            if ($_SESSION["missatge_error"] != "" && !isset($_GET["sol"])) { ?>
                <div class="container-notifications">
                    <p class="hide" id="message" style=""><?php echo $_SESSION["missatge_error"] ?></p>
                </div>
            <?php
                } 
            ?>
            

            <div class="cursor-container">
                <p id="input-word">
                    <!--
                        Aquest input té el mateix que l'span i així al fer POST el pot passar
                        les dades que hi ha
                    -->
                    <input type="hidden" name="paraula" id="paraula">
                    <span id="test-word" name="test-word"></span>               
                    <span id="cursor">|</span>
                </p>
            </div>

            <div class="container-hexgrid">
                <ul id="hex-grid">
                    <li class="hex">
                        <div class="hex-in"><a class="hex-link" data-lletra=<?php echo $_SESSION["lletres"][0]?> draggable="false"><p><?php echo $_SESSION["lletres"][0]?></p></a></div>
                    </li>
                    <li class="hex">
                        <div class="hex-in"><a class="hex-link" data-lletra=<?php echo $_SESSION["lletres"][1]?> draggable="false"><p><?php echo $_SESSION["lletres"][1]?></p></a></div>
                    </li>
                    <li class="hex">
                        <div class="hex-in"><a class="hex-link" data-lletra=<?php echo $_SESSION["lletres"][2]?> draggable="false"><p><?php echo $_SESSION["lletres"][2]?></p></a></div>
                    </li>
                    <li class="hex">
                        <div class="hex-in"><a class="hex-link" data-lletra=<?php echo $_SESSION["lletres"][3]?> draggable="false" id="center-letter"><p><?php echo $_SESSION["lletres"][3]?></p></a></div>
                    </li>
                    <li class="hex">
                        <div class="hex-in"><a class="hex-link" data-lletra=<?php echo $_SESSION["lletres"][4]?> draggable="false"><p><?php echo $_SESSION["lletres"][4]?></p></a></div>
                    </li>
                    <li class="hex">
                        <div class="hex-in"><a class="hex-link" data-lletra=<?php echo $_SESSION["lletres"][5]?> draggable="false"><p><?php echo $_SESSION["lletres"][5]?></p></a></div>
                    </li>
                    <li class="hex">
                        <div class="hex-in"><a class="hex-link" data-lletra=<?php echo $_SESSION["lletres"][6]?> draggable="false"><p><?php echo $_SESSION["lletres"][6]?></p></a></div>
                    </li>
                </ul>
            </div>

            <div class="button-container">
                <button id="delete-button" type="button" title="Suprimeix l'última lletra" onclick="suprimeix()"> Suprimeix</button>
                <button id="shuffle-button" type="button" class="icon" aria-label="Barreja les lletres" title="Barreja les lletres">
                    <svg width="16" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z"></path>
                    </svg>
                </button>
                <button id="submit-button" type="submit" title="Introdueix la paraula">Introdueix</button>
            </div>

            <div class="scoreboard">
                <div>Has trobat <span id="letters-found"><?php echo $_SESSION["paraules_trobades"]?></span> 
                    <?php
                    /**
                     * Mostra "funció" si només hi ha una funció trobada
                     * i mostra "funcions" en cas contrari
                     */
                        if ($_SESSION["paraules_trobades"] == 1) {
                            ?>
                            <span id="found-suffix">funció</span><span id="discovered-text">.</span>
                            <?php
                        }else {
                            ?>
                            <span id="found-suffix">funcions</span><span id="discovered-text">.</span>
                            <?php
                        }
                    ?>
                </div>
                <?php
                /**
                 * Si hi ha alguna funció trobada recorrerà l'array de "funcions_trobades"
                 * i les imprimirà
                 */
                if (isset($_SESSION["funcions_trobades"][0])) {
                ?>
                <div id="score">Funcions trobades: <span>
                    <?php 
                                for ($i=0; $i < count($_SESSION["funcions_trobades"]); $i++) { 
                                    echo "<br>- " . $_SESSION["funcions_trobades"][$i];
                                }

                            
                    ?></span>
                </div>
                <?php
                    }
                ?>
                
                <div id="level"></div>
            </div>
        </div>
    </form>
    <?php
        }  
    ?>

    
    
<script>
    
    function amagaError(){
        if(document.getElementById("message"))
            document.getElementById("message").style.opacity = "0"
    }

    /**
     * Hem fet que quan s'afageixi lletra, també s'afageixi a l'input 
     * per així passar-ho per POST
     */
    function afegeixLletra(lletra){
        document.getElementById("test-word").innerHTML += lletra;
        document.getElementById("paraula").value += lletra;
    }

    //Hem fet que quan es suprimeixi una lletra, també es suprimeixi a l'input 
    function suprimeix(){
        document.getElementById("test-word").innerHTML = document.getElementById("test-word").innerHTML.slice(0, -1)
        document.getElementById("paraula").value = document.getElementById("paraula").value.slice(0, -1)

    }

    window.onload = () => {
        Array.from(document.getElementsByClassName("hex-link")).forEach((el) => {
            el.onclick = ()=>{
                afegeixLletra(el.getAttribute("data-lletra"));
            }
        })

        /**
         * Fem que quan em premi a una lletra de les que hi ha a la pantalla al teclat
         * s'escriurà a la paraula, si premem l'enter s'introduira,
         * si premem esborrar, borrarem i si no hi es la lletra no escriurem res
         */

        document.addEventListener('keydown', (event) => {
            var lletra = event.key;
            var code = event.code;
            if ("<?php echo $_SESSION["lletres"]?>".includes(lletra)) {
                afegeixLletra(lletra);
            }
            if(code == "Enter"){
                document.getElementById("myform").submit();
            }
            if(code == "Backspace"){
                suprimeix();
            }
        }, false);

        document.getElementById("paraula").value = "";

        setTimeout(amagaError, 2000)

        //Anima el cursor
        let estat_cursor = true;
        setInterval(()=>{
            document.getElementById("cursor").style.opacity = estat_cursor ? "1": "0"
            estat_cursor = !estat_cursor
        }, 500)
    }


</script>
</body>
</html>