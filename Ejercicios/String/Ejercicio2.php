<HTML>
<H1> Ejercicio 2 </H1>
<BODY>

<?php
    $ip="192.18.16.204";
    $dirIP = explode(".",$ip);
    echo "<p>IP " . $ip . " en binario es ". decbin($dirIP[0]) .".".decbin($dirIP[1]).".".decbin($dirIP[2]).".".decbin($dirIP[3])." </p>";

    $ip2="10.33.161.2";
    $dirIP2 = explode(".",$ip2);
    echo "<p>IP " . $ip2 . " en binario es ". decbin($dirIP2[0]) .".".decbin($dirIP2[1]).".".decbin($dirIP2[2]).".".decbin($dirIP2[3])." </p>";
?>
</BODY>
</HTML>