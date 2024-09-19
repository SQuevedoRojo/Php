<HTML>
<H1> Ejercicio 1 </H1>
<BODY>

<?php
    $ip="192.18.16.204";
    $dirIP = explode(".",$ip);
    printf("<p>IP " . $ip . " en binario es %b.",$dirIP[0]);
    printf("%b." ,  $dirIP[1] );
    printf("%b." ,  $dirIP[2] );
    printf("%b" ,  $dirIP[3] );
    printf("</p>");

    $ip2="10.33.161.2";
    $dirIP2 = explode(".",$ip2);
    printf("<p>IP " . $ip2 . "en binario es %b.",$dirIP2[0]);
    printf("%b." ,  $dirIP2[1] );
    printf("%b." ,  $dirIP2[2] );
    printf("%b" ,  $dirIP2[3] );
    printf("</p>");
?>
</BODY>
</HTML>