<HTML>
<HEAD><TITLE> EJ1A – NUM IMPARES</TITLE></HEAD>
<BODY>
<?php
    $numImpares = array();
    $indice = 0;
    $suma = "";
    $mediaPares = "";
    $mediaImpares = "";
    print("<table border='1'");
    print("<tr><th>Indice</th><th>Valor</th><th>Suma</th></tr>");
    for ($i=1; $i < 40; $i += 2) { 
        $numImpares[$indice] = $i;
        print("<tr>");
        print("<th>".$indice."</th>");
        print("<th>".$numImpares[$indice]."</th>");
        print("<th>".(intval($suma) + $numImpares[$indice])."</th>");
        print("</tr>");
        $suma = intval($suma)  + $numImpares[$indice];
        $indice++;
    }
    for ($i=0; $i < 20; $i++) { 
        if ($i % 2 == 0)
        {
            $mediaPares = intval($mediaPares) + $numImpares[$i];
        }
        else
        {
            $mediaImpares = intval($mediaImpares) + $numImpares[$i];
        }
    }
    print ("<p>La media de los valores que estan en las posiciones pares es " . (intval($mediaPares) / 10) . "</p>");
    print ("<p>La media de los valores que estan en las posiciones impares es " . (intval($mediaImpares) / 10)) . "</p>";
    
?>
</BODY>
</HTML>
