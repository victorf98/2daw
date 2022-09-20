<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
    
        function encriptacio($text){
            $text = base64_encode($text);
            /*Amb la funcio transformar text ho passem a base62 ja que 
            els simbols els passem a lletres i numeros, deixant un resultat alfanumèric*/
            $result = transformar_text($text);

            return $result;
        }

        function decriptacio($text){
            $final = desfer_codi($text);
            return base64_decode($final);
            
        }

        function transformar_text($text){
            $final_text = "";
            foreach (str_split($text) as $char) {
                //Si el caràcter es minúscula
                if (ord($char) >= 97 and ord($char) <= 122) {
                        $final_text .= chr(90 - ord(strtoupper($char)) + 65);
                //Si el caràcter es majúscula
                }elseif (ord($char) >= 65 and ord($char) <= 90) {
                    $final_text .= chr(122 - ord(strtolower($char)) + 97);
                //Si el caràcter es número
                }elseif (ord($char) >= 48 and ord($char) <= 57) {
                    $final_text .= chr(57 - ord(intval($char)) + 48);
                //Altres
                }else {
                    $final_text .= "sp" . ord($char) . "sp";
                }
            
            }
            return $final_text;
        }

        function desfer_codi($text){
            $array_text = explode("sp", $text);
            $final_text = "";
            foreach ($array_text as $chunk) {
                //Si hi ha un signe codificat
                if (is_numeric($chunk)) {
                    $final_text .= chr(intval($chunk));
                }else{
                    foreach (str_split($chunk) as $char) {
                        //Si el caràcter es minúscula
                        if (ord($char) >= 97 and ord($char) <= 122) {
                            $final_text .= chr(90 - ord(strtoupper($char)) + 65);
                        //Si el caràcter es majúscula
                        }elseif (ord($char) >= 65 and ord($char) <= 90) {
                            $final_text .= chr(122 - ord(strtolower($char)) + 97);
                        //Si el caràcter es número
                        }elseif (ord($char) >= 48 and ord($char) <= 57) {
                            $final_text .= chr(57 - ord(intval($char)) + 48);
                        }
                    }
            
                }
            }
            return $final_text;
        }

        echo encriptacio("Patat€_123zz") . "<br>";
        echo decriptacio("ftu9bcgRTJCUngrAVMLsp61sp")

    ?>
</body>

</html>