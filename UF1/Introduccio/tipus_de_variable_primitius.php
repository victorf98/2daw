<?php
$i = 12;
$x = 1.5;
$t = true;
$c = "php";
$tipus_de_i = gettype( $i );
$tipus_de_x = gettype( $x );
$tipus_de_t = gettype( $t );
$tipus_de_c = gettype( $c );
$tipus_de_tipus = gettype( $tipus_de_i ); 
echo "La variable \$i 
      conté el valor $i 
	  i és del tipus $tipus_de_i,
      la variable \$x
      conté el valor $x
	  i és del tipus $tipus_de_x,
      la variable \$t
      conté el valor $t
	  i és del tipus $tipus_de_t,
      la variable \$c
      conté el valor $c
	  i és del tipus $tipus_de_c
      i la variable \$tipus_de_i
      conté el valor $tipus_de_i
	  i és del tipus $tipus_de_tipus
      ";
?>