<HTML>
<HEAD><TITLE> EJ1AM</TITLE></HEAD>
<BODY>
<?php
    $matriz = array(array());
	$indice = 1;

    for ($i=0; $i < 3; $i++) { 
        
        for ($j=0; $j < 3; $j++) { 
            $matriz[$i][$j] = $indice * 2;
            $indice += 1;
        }
    }
    
    print ("<table border='1'>");
    print("<tr><th>   </th><th>Col 1</th><th>Col 2</th><th>Col 3</th></tr>");
    $indice = 1;
    for ($i=0; $i < count($matriz); $i++) { 
        print("<tr><th>Fil ". $indice ."</th>");
        for ($j=0; $j < count($matriz[$i]); $j++) { 
            print ("<th>" . $matriz[$i][$j] . "</th>");
        }
        $indice += 1;
        print("</tr>");
    }
    print("</table>");

    $sumaFilas = array();
    $sumaColumnas = array();

    $filas = 0;
    $columnas = 0;
    for ($i=0; $i < 3; $i++) { 
        for ($j=0; $j < 3; $j++) { 
            $filas += $matriz[$i][$j];
        }
        $sumaFilas[$i] = $filas;
        $filas = 0;
    }

    for ($i=0; $i < 3; $i++) { 
        for ($j=0; $j < 3; $j++) { 
            $columnas += $matriz[$j][$i];
        }
        $sumaColumnas[$i] = $columnas;
        $columnas = 0;
    }

    print("<br>");

    print ("<table border='1'><tr><th>Suma Filas</th></tr>");
    for ($i=0; $i < count($sumaFilas); $i++) { 
        print("<tr><th>" . $sumaFilas[$i] . "</th></tr>");
    }
    print("</table>");

    print("<br>");

    print ("<table border='1'><tr><th>Suma Columnas</th>");
    for ($i=0; $i < count($sumaColumnas); $i++) { 
        print("<th>" . $sumaColumnas[$i] . "</th>");
    }
    print("</tr></table>");
?>
</BODY>
</HTML>
