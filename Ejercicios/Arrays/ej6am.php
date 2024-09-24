<HTML>
<HEAD><TITLE> EJ1AM</TITLE></HEAD>
<BODY>
<?php
    $matriz = array(array());
    $valoresMaxFil =  array();
    $valoresProFil = array();

    for ($i=0; $i < 3; $i++) { 
        for ($j=0; $j < 3; $j++) { 
            $matriz[$i][$j] = rand();
        }
    }

    print ("<table border='1'>");
    print("<tr><th>   </th><th>Col 1</th><th>Col 2</th><th>Col 3</th></tr>");
    $indice = 1;
    foreach ($matriz as $ma) { 
        print("<tr><th>Fil ". $indice ."</th>");
        foreach ($ma as $m) { 
            print ("<th>" . $m . "</th>");
        }
        $indice += 1;
        print("</tr>");
    }
    print("</table>");

    $suma = 0;
    for ($i=0; $i < 3; $i++) { 
        $valoresMaxFil[$i] = max($matriz[$i]);
        for ($j=0; $j < 3; $j++) { 
            $suma += $matriz[$i][$j];
        }
        $valoresProFil[$i] = $suma/count($matriz[0]);
    }

    print("<br>");

    print ("<table border='1'>");
    print("<tr><th>Valores Maximos</th></tr>");
    $indice = 1;
    foreach ($valoresMaxFil as $vM) { 
        print ("<tr><th>" . $vM . "</th></tr>");
    }
    print("</table>");

    print("<br>");

    print ("<table border='1'>");
    print("<tr><th>Valores Promedio</th></tr>");
    $indice = 1;
    foreach ($valoresProFil as $vP) { 
        print ("<tr><th>" . $vP . "</th></tr>");
    }
    print("</table>");
    
?>
</BODY>
</HTML>
