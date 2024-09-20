<HTML>
<H1> Ejercicio 3 </H1>
<BODY>

<?php

    $ip="192.168.16.100/16";
    $mascara1=substr($ip,-2);
    echo $mascara . "<br>";
    $ipVerdadera1=str_replace("/".$mascara1,"",$ip);
    $dirIP1 = explode(".",$ipVerdadera1);
    $bitsHost1=32-intval($mascara1);
    $bistDirRed1 = substr(decbin($dirIP1[3]),$bitsHost1);
    $UltimaDirRed1 = $UltimaDirBrod1 = $bistDirRed1;
    for ($i=0; $i < $bitsHost1; $i++) { 
        $UltimaDirRed1 = $UltimaDirRed1 . "0";
    }
    $direccionRed1 = $dirIP1[0] .".".$dirIP1[1].".".$dirIP1[2].".". bindec($UltimaDirRed1);
    $PrimeraIP1 = $dirIP1[0] .".".$dirIP1[1].".".$dirIP1[2].".". (bindec($UltimaDirRed1)+1);
    for ($i=0; $i < $bitsHost1; $i++) { 
        $UltimaDirBrod1= $UltimaDirBrod1 . "1";
    }
    $IpBroadcast1 = $dirIP1[0] .".".$dirIP1[1].".".$dirIP1[2].".". bindec($UltimaDirBrod1);
    $UltimaIP2 = $dirIP1[0] .".".$dirIP1[1].".".$dirIP1[2].".". (bindec($UltimaDirBrod1)-1);

    echo "IP : ". $ipVerdadera1 . "<br>";
    echo "Mascara : ". $mascara1 . "<br>";
    echo "Direccion Red : ". $direccionRed1 . "<br>";
    echo "Direccion Broadcast : ". $IpBroadcast1 . "<br>";
    echo "Rango :  ". $PrimeraIP1 . " a " . $UltimaIP2 . "<br>";

    $ip2="192.168.16.100/21";
    

    $ip3="10.33.15.100/8";


?>
</BODY>
</HTML>