<HTML>
<HEAD><TITLE> EJ5B – Tabla multiplicar con TD</TITLE></HEAD>
<BODY>
<?php
    $num="8";
    print ("<table border='1'>");
    for ($i=1; $i <= 10; $i++) { 
        print ("<tr><th>". $num . " x " . $i . "</th><th> " . ($num * $i) . " </th></tr>");
    }
    print("</table>");
?>
</BODY>
</HTML>