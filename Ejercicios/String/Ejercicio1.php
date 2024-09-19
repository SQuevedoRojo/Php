<HTML>
<H1> Ejercicio 1 </H1>
<BODY>

<?php
    $ip="192.18.16.204";
    $dirIP = explode(".",$ip);
    echo $dirIP[0];
    echo $dirIP[1];
    echo $dirIP[2];
    echo $dirIP[3];
    printf("<p>IP " . $ip . " en binario es %b",$dirIP[0] . ".%b." ,$dirIP[1] . ".%b.",$dirIP[2] . ".%b",$dirIP[3] . " </p>");


    $ip2="10.33.161.2";
    $dirIP2 = explode(".",$ip2);
    printf("<p>IP " . $ip2 . "en binario es %b",$dirIP2[0] . ".%b." ,$dirIP2[1] . ".%b.",$dirIP2[2] . ".%b",$dirIP2[3] . "</p>");
?>
</BODY>
</HTML>