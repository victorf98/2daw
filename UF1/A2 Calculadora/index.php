<!DOCTYPE html>
<html lang="ca">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Calculadora</title>
</head>
<body>
    <div class="container">
        <form name="calc" class="calculator" method="post">
            <!--Creem aquests inputs que estan hidden per anar posant-hi tots els valors
        dels botons que anem clicant amb la funció "concatenar() i l'últim resultat a la
        funció ultimResultat()"-->
            <input type="hidden" readonly name="ultim_resultat" value=<?php echo ultimResultat();?>></label>
            <input type="hidden" readonly name="concat" value=<?php echo concatenar();?>></label>
            <input type="text" class="value" readonly name="resultat" value="<?php echo calcular();?>" />
            <span class="num"><input type ="submit" name="boto" value="("></span>
            <span class="num"><input type ="submit" name="boto" value=")"></span>
            <span class="num"><input type ="submit" name="boto" value="SIN"></span>
            <span class="num"><input type ="submit" name="boto" value="COS"></span>
            <span class="num clear"><input type ="submit" name="boto" value="C"></span>
            <span class="num"><input type ="submit" name="boto" value="/"></span>
            <span class="num"><input type ="submit" name="boto" value="*"></span>
            <span class="num"><input type ="submit" name="boto" value="7"></span>
            <span class="num"><input type ="submit" name="boto" value="8"></span>
            <span class="num"><input type ="submit" name="boto" value="9"></span>
            <span class="num"><input type ="submit" name="boto" value="-"></span>
            <span class="num"><input type ="submit" name="boto" value="4"></span>
            <span class="num"><input type ="submit" name="boto" value="5"></span>
            <span class="num"><input type ="submit" name="boto" value="6"></span>
            <span class="num plus"><input type ="submit" name="boto" value="+"></span>
            <span class="num"><input type ="submit" name="boto" value="1"></span>
            <span class="num"><input type ="submit" name="boto" value="2"></span>
            <span class="num"><input type ="submit" name="boto" value="3"></span>
            <span class="num"><input type ="submit" name="boto" value="0"></span>
            <span class="num"><input type ="submit" name="boto" value="00"></span>
            <span class="num"><input type ="submit" name="boto" value="."></span>
            <span class="num"><input type ="submit" name="boto" value="%"></span>
            <span class="num"><input type ="submit" name="boto" value="ANS"></span>
            <span class="num"><input type ="submit" name="boto" value="<<"></span>
            <span class="num"><input type ="submit" name="boto" value="π"></span>
            <span class="num"><input type ="submit" name="boto" value="^"></span>
            <span class="num equal"><input type ="submit" name="boto" value="="></span>
            
        </form>
    </div>

    <?php
    /**
     * Aquesta funció és l'encarregada de fer els càlculs que farà la calculadora
     */
    function calcular(){
        //Fem que es retorni un espai perquè les etiquetes encara no tenen valor
        if (!isset($_POST["boto"]) || !isset($_POST["resultat"]) || !isset($_POST["concat"])) {
            return "";
        }

        //Fiquem els POST a variables perquè el codi sigui més llegible
        $resultat = $_POST["resultat"];
        $boto = $_POST["boto"];
        $concat = $_POST["concat"];
        $ultim_resultat = $_POST["ultim_resultat"];

        //Si ens intenten introduir valors fora dels de la calculadora es retorna un missatge
        if (valorIncorrecte($boto)) {
            return "No toca";
        }

        //Si volem fer una operació hem de tenir valors a la calculadora, sino donaria ERROR
        if ($boto == "=" 
        && $resultat != "") {
            //Fem un try-catch per intentar controlar excepcions (numeros dividits per 0 i altres errors)
            try{
                eval("\$calcul = " . $resultat . ";");
                return round($calcul, 4);
            }catch(DivisionByZeroError $e){
                return "INF";
            }catch(ParseError $p){
                return "ERROR";
            }
            /**
             * Buidem la calculadora si li donem a la "C" 
             * o tindrem un espai en blanc si li donem a "=" i ja està en blanc
             */
        }elseif($boto == "C" 
        || ($boto == "=" && $resultat == "")){
            return "";
            /**
             * El botó "ANS" ens guarda el resultat de l'última operació feta.
             * Si l'últim resultat ha set "ERROR" o "INF", el botó no farà res
             */
        }elseif($boto == "ANS"){
            if ($resultat == "" && is_numeric($ultim_resultat)) {
                return $ultim_resultat;
            }elseif(is_numeric($ultim_resultat) && substr($concat, -1) != "="){
                return $resultat . $ultim_resultat;
            }else {
                return $resultat;
            }
            /**
             * Aquest botó borra l'últim caràcter afegit excepte
             * si el que hi ha a la pantalla és el resultat d'una operació (un nombre, ERROR o INF)
             * en el qual cas es posa en blanc la pantalla
             */
        }elseif($boto == "<<"){
            if (substr($concat, -1) == "=") {
                return "";
            }else {
                return substr($resultat, 0, -1);
            }
            /**
             * Si volem els sinus o cosinus d'un nombre agafarem el nombre que s'hagi esscrit
             * a no ser que hi hagi un operador al final
             */
        }elseif(($boto == "SIN" || $boto == "COS") 
        && (substr($concat, -1) != "=" && substr($concat, -1) != "C")){
            if (preg_match("/(\+|\-|\*|\/|\%)/" ,substr($resultat, -1))){
                return $resultat . $boto . "(";
            }else {
                return $boto . "(" . $resultat . ")";
            }
            /**
             * Si hi ha un nombre i un parèntesis es posarà automàticament
             * el signe de multiplicació
             */
        }elseif($boto == "(" && is_numeric(substr($concat, -1))){
            return $resultat . "*(";
            //Si l'últim botó apretat és "=" o "C" no concatenarem més a l'input
        }elseif (substr($concat, -1) == "=" || substr($concat, -1) == "C") {
            if ($boto == "SIN" || $boto == "COS") {
                return $boto . "(";
            }elseif($boto == "π"){
                return "3.1415";
            }elseif($boto == "^"){
                return "**";
            }else {
                return $boto;
            }
            //Concatenem el que hi ha a l'input amb el botó apretat
        }else{
            if ($boto == "π") {
                return $resultat . "3.1415";
            }elseif($boto == "^"){
                return $resultat . "**";
            }else{
                return $resultat . $boto;
            }
        }
    }

    /**
     * Aquesta funció concatena cada botó de la calculadora que es va apretant
     * per així fer un "reset" després d'una operació o saber quan hi ha 
     * un operador al final per encapsular un nombre o no a l'hora de fer
     * sinus o cosinus
     */
    function concatenar(){
        if (!isset($_POST["boto"]) || !isset($_POST["concat"])) {
            return "";
        }

        $concat = $_POST["concat"];
        $boto = $_POST["boto"];
        
        if ($concat == "") {
            return $boto;
        }else{
            return $concat . $boto;
        }
    }

    //Aquesta funció emmagatzema l'últim resultat que hi ha hagut a la calculadora
     
    function ultimResultat(){
        if (!isset($_POST["boto"]) || !isset($_POST["resultat"])) {
            return "";
        }

        $resultat = $_POST["resultat"];
        $boto = $_POST["boto"];
        $ultim_resultat = $_POST["ultim_resultat"];

        if ($boto == "=" 
        && $resultat != "") {
            try{
                eval("\$calcul = " . $resultat . ";");
                return round($calcul, 4);
            }catch(DivisionByZeroError $e){
                return "INF";
            }catch(ParseError $p){
                return "ERROR";
            }
        }else {
            return $ultim_resultat;
        }
    }

    /**
     * Aquesta funció ens comprova que no ens introdueixin caràcters que no pertanyin
     * a la calculadora
     */
    function valorIncorrecte($boto){
        if (!str_contains("C*/-+=.12345678900()SINCOSANS<<π^%", $boto)) {
            return true;
        }else {
            return false;
        }
    }
    ?>
</body>