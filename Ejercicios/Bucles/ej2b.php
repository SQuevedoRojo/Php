<HTML>
<HEAD><TITLE> EJ2B – Conversor Decimal a base n </TITLE></HEAD>
<BODY>
<?php
    $num="48";
    $base="8";
    $numeroEnBase = "";
    $copia = $num;
    while ($num > 0) 
    {
        $resto = "";
        $resto = $num % $base;
        $numeroEnBase = $resto . $numeroEnBase;
        $num = floor($num/$base);
    }
    echo "El numero " . $copia . " en base " . $base . " es "  . $numeroEnBase;


?>
</BODY>
</HTML>