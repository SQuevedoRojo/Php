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
    
    $columna = $fila = 0;
    $elementoMayor = 0;

    for ($i=0; $i < count($matriz); $i++) { 
        for ($j=0; $j < count($matriz[$i]); $j++) { 
            if($matriz[$i][$j] > $elementoMayor)
            {
                $elementoMayor = $matriz[$i][$j];
                $fila = $i + 1;
                $columna = $j +1;
            }
        }
    }

    print("<h3>Elemento Mayor ". $elementoMayor . " -- Fila ". $fila ." Columna " . $columna . "</h3>");
?>
</BODY>
</HTML>
