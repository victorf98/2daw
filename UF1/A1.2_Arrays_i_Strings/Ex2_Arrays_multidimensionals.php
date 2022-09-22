<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
        /**
         * Aquesta funció crea una array multidimensional
         * amb les mides que es passen per paràmetre (n x n)
         * i l'emplena.
         */
        function creaMatriu($n):array{
            $matrix = array();
            /**
             * Un cop creada una array fem un loop
             * per crear dins d'aquesta tantes
             * arrays com es passi al paràmetre $n.
             */
            for ($y=0; $y < $n; $y++) { 
                $matrix[$y] = array();
            }
            //Fem un doble for per eplenar l'array bidimensionalment
            for ($i=0; $i < $n; $i++ ) { 
               for ($x=0; $x < $n; $x++) { 
                    if ($i == $x) {
                        $matrix[$i][$x] = "*";
                    }elseif ($x > $i){
                        $matrix[$i][$x] = $i + $x;
                    }else {
                        $matrix[$i][$x] = rand(10, 20);
                    }
               }
            }

            return $matrix;
        }

        /**
         * mostraMatriu() genera el codi HTML per crear una taula
         * amb tota la informació de l'array emplenada a 
         * creaMatriu().
         */
        function mostraMatriu($array):string{
            $taula = "<table>";
            for ($i=0; $i < count($array); $i++ ) { 
                $taula .= "<tr>";
                for ($x=0; $x < count($array); $x++) { 
                     $taula .= "<td>" . $array[$i][$x] . "</td>";
                }
                $taula .= "</tr>";
            }
            $taula .= "</table>";
            return $taula;
        }

        /**
         * transposaMatriu() gira els índexs de cada
         * item a l'array multidimensional creada a creaMatriu().
         * És a dir el valor de $array[1][2] passa a estar
         * a $array[2][1] i viceversa.
         */
        function transposaMatriu($array):array{
            /**
             * Per poder intercanviar les dades d'índex
             * creem una còpia per així no perdre la informació
             * de l'array original.
             */
            $copia = $array;
            for ($i=0; $i < count($array); $i++ ) { 
                for ($x=0; $x < count($array); $x++) { 
                     if ($x != $i){
                         $array[$i][$x] = $copia[$x][$i];
                    }
                }
             }
             
             return $array;
        }

        $matrix = creaMatriu(4);
        echo mostraMatriu($matrix) . "<br>";
        $new_matrix = transposaMatriu($matrix);
        echo mostraMatriu($new_matrix);
    ?>
</body>

</html>