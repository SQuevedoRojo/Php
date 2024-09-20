<HTML>
<HEAD><TITLE> EJ1B – Conversor decimal a binario</TITLE></HEAD>
<BODY>
<?php
$num="168";
$binario = "";
    while ($num > 0) 
    {
        $resto = "";
        $resto = $num % 2;
        $binario = $resto . $binario;
        $num /= 2;
    }
?>
</BODY>
</HTML>