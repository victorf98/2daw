<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
    
        function encriptacio($text, $ip){
            $text = iconv("UTF-8", "ASCII//TRANSLIT", $text);
            $ip_bin = decbin(sumar_caracters($ip));
            $sum = sumar_digits($ip_bin);

            return transformar_text($text, $sum);
        }

        function decriptacio($text, $ip){
            $ip_bin = decbin(sumar_caracters($ip));
            $sum = sumar_digits($ip_bin);

            return desfer_codi($text, $sum);
        }

        function transformar_text($text, $sum){
            $final_text = "";
            foreach (str_split($text) as $char) {
                //Si el caràcter es minúscula
                if (ord($char) >= 97 and ord($char) <= 122) {
                    if (ord(strtoupper($char)) + $sum > ord("Z")) {
                        $final_text .= chr(ord("A") + (ord(strtoupper($char)) + $sum) - ord(strtoupper($char)));
                    }else {
                        $final_text .= chr(ord(strtoupper($char)) + $sum);
                    }
                //Si el caràcter es majúscula
                }elseif (ord($char) >= 65 and ord($char) <= 90) {
                    $final_text .= strval(ord($char));
                //Si el caràcter es número
                }elseif (ord($char) >= 48 and ord($char) <= 57) {
                    $final_text .= chr(ord("a") + intval($char));
                //Altres
                }else {
                    $final_text .= "sp00" . ord($char);
                }
            }

            return $final_text;
        }

        function desfer_codi($text, $sum){
            $text_array = str_split($text);
            for ($i=0; $i < count($text_array); $i++) { 
                if ($text_array[i]) {
                    
                }
            } 
            
        }

        function sumar_caracters($text){
            $suma = 0;
            foreach (str_split($text) as $caracter) {
                $suma += ord($caracter);
            }
            return $suma;
        }

        function sumar_digits($num){
            $sum = 0;
            while ($num != 0) {
                $sum += $num % 10;
                $num = intdiv($ip_bin, 10);
            }
            return $sum;
        }

        echo encriptacio("Patata_123zz", $_SERVER['REMOTE_ADDR']);

    ?>
</body>

</html>