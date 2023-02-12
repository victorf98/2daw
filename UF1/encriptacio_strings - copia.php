<?php
    function decrypt($text)
    {
        $divided_text = str_split($text, 3);
        $reversed_letters = "";
        foreach ($divided_text as $group) {
            $reversed_letters .= strrev($group);
        }
        $final_code = "";
        foreach (str_split($reversed_letters) as $letter) {
            if($letter == " ")
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
?>