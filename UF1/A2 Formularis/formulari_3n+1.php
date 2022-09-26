<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Formulari 3n + 1</title>

</head>

<body>

<div style="margin: 30px 10%;">
<h3>3n + 1</h3>
<form action="" method="post" id="myform" name="myform">

	<label>Numero</label> <input type="number" value="" size="30" maxlength="100" name="mynumber" id="" /><br /><br />
   
	<button id="mysubmit" type="submit">Submit</button><br /><br />

</form>
</div>

<?php
        if (array_key_exists("mynumber", $_REQUEST)) {
            $numero = $_REQUEST["mynumber"];
            $array[] = $numero;
            if ($numero < 1) {
                print_r("El numero ha de ser més gran que 0");
            }else{
                while ($numero != 1) {
                    if ($numero % 2 == 0) {
                        $numero = $numero / 2;
                        $array[] = $numero;
                    }else {
                        $numero = $numero * 3 + 1;
                        $array[] = $numero;
                    }
                }
                print_r("La sequüència del " . $array[0] . " és: ");
                foreach ($array as $key => $value) {
                    print_r($value . " ");
                }
                print_r(". S'ha arraibat a " . count($array) . " iteracons i arribant a un màxim de " . max($array));
            }
            }else {
                die("Introdueix un nombre.");
            }
        

    ?>

</body>
</html>