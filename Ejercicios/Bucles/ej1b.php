<HTML>
<HEAD><TITLE> EJ1B – Conversor decimal a binario</TITLE></HEAD>
<BODY>
<?php
$num="168";
$binario = "";
$copia = $num;
    while ($num > 0) 
    {
        $resto = "";
        $resto = $num % 2;
        $binario = $resto . $binario;
        $num = floor($num/2);
    }
    echo "El numero " . $copia . " en binario es "  . $binario;
?>
</BODY>
</HTML>