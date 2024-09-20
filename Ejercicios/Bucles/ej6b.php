<HTML>
<HEAD><TITLE> EJ6B – Factorial</TITLE></HEAD>
<BODY>
<?php
    $num="-1";
    $copia = $num;
    $factorial = 1;
    if ($num == 0)
    {
    	echo "El factorial de 0 es 1";
    }
    elseif ($num < 0)
    {
    	echo "No existe el factorial de un numero negativo";
    }
    else 
    {
    	while ($num > 0) 
        {
        $factorial *= $num;
        $num -= 1;
        }
        echo "El factorial de " . $copia . " es " . $factorial;
    }
?>
</BODY>
</HTML>
