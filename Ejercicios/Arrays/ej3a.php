<HTML>
<HEAD><TITLE> EJ1A – NUM IMPARES</TITLE></HEAD>
<BODY>
<?php
    $numBinarios = array();
    $numeroOct = "";
    print("<table border='1'");
    print("<tr><th>Indice</th><th>Binario</th><th>Octal</th></tr>");
    for ($i=0; $i < 20; $i++) { 
        print("<tr>");
        print("<th>".$i."</th>");
        if ($i == 0)
        {
            $numBinarios[$i] = 0;
            $numeroOct = 0;
        }
        else
        {
            $numBinarios[$i] = decbin($i);
            $numeroOct = decoct($i);
        }
        print("<th>".$numBinarios[$i]."</th>");
        print("<th>".$numeroOct."</th>");
        print("</tr>");
        $numeroOct = "";
    }
    
?>
</BODY>
</HTML>
