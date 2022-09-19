<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
        function decrypt($text)
        {
            $divided_text = str_split($text, 3);
            $reversed_letters = "";
            foreach ($divided_text as $group) {
                $reversed_letters .= strrev($group);
            }
            return opposite_letter($reversed_letters);
        }

        function opposite_letter($text){
            $final_code = "";
            foreach (str_split($text) as $letter) {
                if(ord($letter) > 122 or ord($letter) < 97)
                    $final_code .= $letter;
                else
                {
                    $final_code .= chr(122 - ord($letter) + 97);
                }
            }
            return $final_code;
        }

        $text = "kfhxivrozziuortghrvxrrkcrozxlwflrh";
        echo decrypt($text);
        echo "<br>";
        $text = " hv ovxozwozv vj o vfrfjvivfj h vmzvlo e hrxvhlmov oz ozx.vw z xve hv loqvn il hv lmnlg izxvwrhrvml ,hv b lh mv,rhhv mf w zrxvlrh.m";
        echo decrypt($text);

    ?>
</body>

</html>