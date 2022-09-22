<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
        /**
         * Aquesta funció passa una array de números a 
         * una array amb els factorials d'aquests. Si no es passa
         * una array o a l'array hi ha algun item que no sigui 
         * un numero es retornarà false.
         */
        function factorialArray($numeros): array | bool{
            if (!is_array($numeros)) {
                return false;
            }else {
                $factorials = array();
                //Es recorre cada item a l'array
                for ($i=0; $i < count($numeros); $i++) {
                    if (!is_numeric($numeros[$i])) {
                        return false;
                    }else{
                        $factorials[$i] = factorial($numeros[$i]);
                    }
                }
                return $factorials;
            }
        }

        /**
         * Funció recursiva que calcula el factorial d'un número.
         * Si el número és negatiu es retornarà -99999.
         * Si el número és 0 es retorna 1 directament.
         */
        function factorial($numero){
            if ($numero == 1) {
                return $numero * 1;
            }elseif($numero < 0){
                return -99999;
            }elseif($numero == 0){
                return 1;
            }else {
                return $numero * factorial($numero - 1);
            }
        }

        #prova1 --> funciona
        $numeros = array(2, 3, 10, 5);
        var_dump("Array" . "<br>");
        var_dump($numeros);
        var_dump("<br>");
        var_dump("Prova" . "<br>");
        var_dump(factorialArray($numeros));
        var_dump("<br>");
        #prova2 --> retrona false
        $cosa = 1232;
        var_dump("Array" . "<br>");
        var_dump($cosa);
        var_dump("<br>");
        var_dump("Prova" . "<br>");
        var_dump(factorialArray($cosa));
        var_dump("<br>");
        
        #prova3 -> retorna false
        $array = array(2, "da");
        var_dump("Array" . "<br>");
        var_dump($array);
        var_dump("<br>");
        var_dump("Prova" . "<br>");
        var_dump(factorialArray($array));
        var_dump("<br>");
        
        #prova4 --> funciona: transforma numero negatiu en -99999
        $last = array(2, -1);
        var_dump("Array" . "<br>");
        var_dump($last);
        var_dump("<br>");
        var_dump("Prova" . "<br>");
        var_dump(factorialArray($last));
    ?>
</body>

</html>