<HTML>
<HEAD><TITLE> EJ1AM</TITLE></HEAD>
<BODY>
<?php
    $alumnos = array("Joel" => array("DWES" => 7,"DWEC" => 8,"DIW" => 5,"DAW" => 8),"William" => array("DWES" => 9,"DWEC" => 7,"DIW" => 4,"DAW" => 6),"Quevedo" => array("DWES" => 5,"DWEC" => 7,"DIW" => 6,"DAW" => 7),"Hugo" => array("DWES" => 3,"DWEC" => 1,"DIW" => 8,"DAW" => 9),"Javi" => array("DWES" => 7,"DWEC" => 2,"DIW" => 7,"DAW" => 4),"Maria" => array("DWES" => 5,"DWEC" => 6,"DIW" => 2,"DAW" => 3),"Claudia" => array("DWES" => 4,"DWEC" => 3,"DIW" => 7,"DAW" => 9),"Canseco"=> array("DWES" => 1,"DWEC" => 5,"DIW" => 7,"DAW" => 6),"Alba" => array("DWES" => 5,"DWEC" => 8,"DIW" => 6,"DAW" => 9),"Guillermo"=> array("DWES" => 3,"DWEC" => 7,"DIW" => 4,"DAW" => 9));
	$indice = 1;

    $m = array("",0);
    $m2 = array("",0);
    $m3 = array("",0);
    $m4 = array("",0);


    foreach ($alumnos as $nombres => $modulos)
    {
        print($nombres . " -> ");
        foreach ($modulos as $modulo => $nota) {
            switch ($modulo) {
                case "DWES":
                    if($nota > $m[1])
                    {
                        $m[0] = $nombre;
                        $m[1] = $nota;
                    }
                    break;
                case "DWEC":
                    if($nota > $m2[1])
                    {
                        $m2[0] = $nombre;
                        $m2[1] = $nota;
                    }
                    break;
                case "DIW":
                    if($nota > $m3[1])
                    {
                        $m3[0] = $nombre;
                        $m3[1] = $nota;
                    }
                    break;
                case "DAW":
                    if($nota > $m4[1])
                    {
                        $m4[0] = $nombre;
                        $m4[1] = $nota;
                    }
                    break;
            }
        }
    }

    print ("<h1>A.-</h1><br>");

    print("<h2>Mayor nota en DWES -> " . $m[0] . " | ". $m[1] . "</h2>");
    print("<h2>Mayor nota en DWEC -> " . $m2[0] . " | ". $m2[1] . "</h2>");
    print("<h2>Mayor nota en DIW -> " . $m3[0] . " | ". $m3[1] . "</h2>");
    print("<h2>Mayor nota en DAW -> " . $m4[0] . " | ". $m4[1] . "</h2>");
?>
</BODY>
</HTML>
