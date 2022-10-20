<?php

    function canviarLletres($data){
        //Calculem el temps que es tarda en calcular
        $starttime = microtime(true);

        //Creem totes les variables necessàries
        $abecedari = "abcdefghijklmnopqrstuvwxyz0123456789_";
        $_SESSION["funcions"] = array();
        $_SESSION["data"] = $data;
        $nFuncions = 0;
        $funcions = get_defined_functions()["internal"];
        $funcions_max_7 = array();
        //Creem la seed del rand
        srand(strtotime($_SESSION["data"]));

        //Fem una array de només les funcions que tenen 7 caràcters o menys
        foreach ($funcions as $funcio) {
            if (count(array_unique(str_split($funcio))) <= 7) {
                array_push($funcions_max_7, $funcio);
            }
        }

        while ($nFuncions < 3) {
            //Fem una copia de les funcions per poder modificar-la posteriorment
            $copia_funcions = $funcions_max_7;
            //Creem varies variables que necessitarem;
            $funcions_amb_lletra_mig = array();
            $lletres = "";
            $a = 0;
            $i = 0;
            $nFuncions = 0;
            //Creem la string de 7 lletres, comprovant que no es repeteixin
            while($a < 7){
                $lletra = $abecedari[rand(0, strlen($abecedari) - 1)];
                if (!str_contains($lletres, $lletra)) {
                    $lletres .= $lletra;
                    $a += 1;
                }
            }

            //Fem una nova array amb nomes les lletres que tindran la lletra del mig
            foreach ($copia_funcions as $funcio) {
                if (preg_match("/$lletres[3]/", $funcio)) {
                    array_push($funcions_amb_lletra_mig, $funcio);
                }
            }
            
            $lletres_split = str_split($lletres);

            //Recorrem totes les funcions o fins que trobem al menys 3 funcions que es poden fer amb les lletres
            while ($i < count($funcions_amb_lletra_mig) && $nFuncions < 3) {
                $funcio_split = str_split($funcions_amb_lletra_mig[$i]);
                $diferencia = array_diff($funcio_split, $lletres_split);

                /**
                 * Si no hi ha diferencia entre la funcio agafada i les lletres 
                 * vol dir que es pot fer la funcio amb les lletres que tenim
                 */
                if (empty($diferencia)) {
                    $nFuncions += 1;
                }
                $i += 1;
            }
        }

        //Emplenem una array amb les funcions que es poden fer amb les lletres: les solucions
        foreach ($funcions_amb_lletra_mig as $funcio) {
            $funcio_split = str_split($funcio);
            $diferencia = array_diff($funcio_split, $lletres_split);

            if (str_contains($funcio, $lletres[3]) && empty($diferencia)) {
                array_push($_SESSION["funcions"], $funcio);
            }
        }

        $_SESSION["lletres"] = $lletres;

        //Calculem el temps de càrrega de la pàgina
        $endtime = microtime(true);
            
        $_SESSION["carrega"] = "Temps: " . ($endtime - $starttime);

}
?>