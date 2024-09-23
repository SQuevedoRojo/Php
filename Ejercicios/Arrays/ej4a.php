<HTML>
<HEAD><TITLE> EJ4A – ARRAY INVERSO</TITLE></HEAD>
<BODY>
<?php
    $numBinarios = array();
    $numeroOct = "";
    print("<table border='1'");
    print("<tr><th>Indice</th><th>Binario</th><th>Octal</th></tr>");
    for ($i=0; $i < 20; $i++) { 
        print("<tr>");
        print("<th>".$i."</th>");
        $numBinarios[$i] = decbin($i);
        $numeroOct = decoct($i);
        print("<th>".$numBinarios[$i]."</th>");
        print("<th>".$numeroOct."</th>");
        print("</tr>");
        $numeroOct = "";
    }
    print ("</table>");
    $arrayInverso = array_reverse($numBinarios);
    echo "<h2>Array inverso</h2>";
    for ($i=0; $i < count($arrayInverso); $i++) { 
        print("<p>". $arrayInverso[$i] ."</p><br>");
    }
?>
</BODY>
</HTML>
