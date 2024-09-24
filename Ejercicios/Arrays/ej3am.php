<HTML>
<HEAD><TITLE> EJ1AM</TITLE></HEAD>
<BODY>
<?php
    $matriz = array(array());
	$indice = 1;

    for ($i=0; $i < 3; $i++) { 
        
        for ($j=0; $j < 5; $j++) { 
            $matriz[$i][$j] = $indice * 2;
            $indice += 1;
        }
    }
    
    print ("Elementos por fila -->  ");

    for ($i=0; $i < count($matriz); $i++) { 
        for ($j=0; $j < count($matriz[$i]); $j++) { 
            print ($matriz[$i][$j] . " | ");
        }
    }

    print("<br>");

    print ("Elementos por columna --> ");

    for ($i=0; $i < count($matriz[0]); $i++) { 
        for ($j=0; $j < count($matriz); $j++) { 
            print ($matriz[$j][$i] . " | ");
        }
    }
?>
</BODY>
</HTML>
