<?php
    function decrypt($text)
    {
        return rev_three_letters($text);
    }

    $text = "kfhxivrozziuortghrvxrrkcrozxlwflrh";
    $divided_text = str_split($text);
    $reversed_letters = "";
    foreach ($divided_text as $group) {
        $reversed_letters .= strrev($group);
    }

    echo $reversed_letters;
?>