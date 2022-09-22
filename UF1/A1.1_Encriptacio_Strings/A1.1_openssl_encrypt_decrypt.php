<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
        $cadena = "Hello World";
        
        echo "Cadena a encriptar: " . $cadena . "<br>";
        
        $cifratge = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($cifratge);
        $options = 0;
        $vector_inicialitzacio = '1234567891011121';
        $key = "patata123";
        $encriptacio = openssl_encrypt($cadena, $cifratge, $key, $options, $vector_inicialitzacio);
        
        echo "Cadena encriptada: " . $encriptacio . "<br>";

        $desenctriptacio = openssl_decrypt ($encriptacio, $cifratge, $key, $options, $vector_inicialitzacio);
        
        echo "Cadena desencriptada: " . $desenctriptacio . "<br>";

    ?>
</body>

</html>