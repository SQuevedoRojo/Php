<HTML>
<HEAD><TITLE> EJ3B – Conversor Decimal a base 16</TITLE></HEAD>
<BODY>
<?php
    $num="1515";
    $base="16";
    $copia = $num;
    $numeroEnBase = "";
    while ($num > 0) 
    {
        $resto = "";
        $resto = $num % $base;
        if ($resto < 10) {
            $numeroEnBase = $resto . $numeroEnBase;
        } else {
            switch ($resto) {
                case '10':
                    $numeroEnBase = "A" . $numeroEnBase;
                    break;
                case '11':
                    $numeroEnBase = "B" . $numeroEnBase;
                    break;
                case '12':
                    $numeroEnBase = "C" . $numeroEnBase;
                    break;
                case '13':
                    $numeroEnBase = "D" . $numeroEnBase;
                    break;
                case '14':
                    $numeroEnBase = "E" . $numeroEnBase;
                    break;
                case '15':
                    $numeroEnBase = "F" . $numeroEnBase;
                    break;
            }
        }
        $num = floor($num/$base);
    }
    echo "El numero " . $copia . " en base " . $base . " es "  . $numeroEnBase;
?>
</BODY>
</HTML>