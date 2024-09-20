<HTML>
<HEAD><TITLE> EJ1A – NUM IMPARES</TITLE></HEAD>
<BODY>
<?php
    $numImpares = array();
    $indice = 0;
    $suma = "";
    print("<table border='1'");
    print("<tr><th>Indice</th><th>Valor</th><th>Suma</th></tr>");
    for ($i=1; $i < 21; $i += 2, $indice++) { 
        $numImpares[$indice] = $i;
        print("<tr>");
        print("<th>".$indice."</th>");
        print("<th>".$numImpares[$indice]."</th>");
        print("<th>".($suma + $numImpares[$indice])."</th>");
        print("</tr>");
        $suma += $numImpares[$indice];
    }
?>
</BODY>
</HTML>
