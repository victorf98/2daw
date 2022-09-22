<?php
$d = new DateTime();
$tipus_de_d = gettype( $d );
echo "La variable \$d 
      conté el valor " . get_class($d)/*$d->format( "d/m/Y")*/ .
	  " i és del tipus $tipus_de_d";
?>