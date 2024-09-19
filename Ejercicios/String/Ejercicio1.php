<HTML>
<H1> Ejercicio 1 </H1>
<BODY>

<?php
    $ip="192.18.16.204";
    $dirIP;
    $dirIP = explode('.',$IP);
    printf("<p>IP " . $ip . " en binario es %b",$dirIP[0],$dirIP[1],$dirIP[2],$dirIP[3] . "</p>");


    $ip2="10.33.161.2";
    $dirIP2;
    $dirIP2 = explode('.',$IP2);
    printf("<p>IP " . $ip2 . "en binario es %b ",$dirIP2[0],$dirIP2[1],$dirIP2[2],$dirIP2[3] . "</p>");
?>
</BODY>
</HTML>