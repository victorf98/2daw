<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
    
        function encriptacio($text, $ip){
            $ip_bin = decbin(sumar_caracters($ip));
            $sum = 0;
            while ($ip_bin != 0) {
                $sum += $ip_bin % 10;
                $ip_bin = intdiv($ip_bin, 10);
            }

            transformar_text($text);
        }

        function sumar_caracters($text){
            $suma = 0;
            foreach (str_split($text) as $caracter) {
                $suma += ord($caracter);
            }
            return $suma;
        }

        function tranformar_text($text){
            $final_text = "";
            foreach ($text as $char) {
                if (IntlChar::isupper($char)) {
                    $final_text .= chr(ord(strtolower($char)) + $sum);
                }elseif (IntlChar::islower($char)) {
                    $final_text .= strval(ord($char))
                }elseif (is_numeric($char)) {
                    $final_text .= chr(ord("A") + intval($char));
                }else {
                    $final_text .= "sp00" . intval($char);
                }
            }

            return $final_text;
        }

    ?>
</body>

</html>