<HTML>
<HEAD><TITLE> EJ1AM</TITLE></HEAD>
<BODY>
<?php
    $matriz = array(array());

    for ($i=0; $i < 5; $i++) { 
        for ($j=0; $j < 3; $j++) { 
            $matriz[$i][$j] = ($i+ 1) + ($j + 1);
        }
    }

    print ("<table border='1'>");
    print("<tr><th>Col 1</th><th>Col 2</th><th>Col 3</th></tr>");
    for ($i=0; $i < count($matriz); $i++) { 
        print("<tr>");
        for ($j=0; $j < count($matriz[$i]); $j++) { 
            print ("<th>" . $matriz[$i][$j] . "</th>");
        }
        $indice += 1;
        print("</tr>");
    }
    print("</table>");
    
    
?>
</BODY>
</HTML>
