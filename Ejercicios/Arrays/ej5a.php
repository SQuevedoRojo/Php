<HTML>
<HEAD><TITLE> EJ5A</TITLE></HEAD>
<BODY>
<?php
    $array1a = array();
    $array1b = array();
    $array1c = array();
    $array2 = array();
    $array3 = array();

    $array1a[0] = "Bases Datos";
    $array1a[1] = "Entornos Desarrollo";
    $array1a[2] = "Programación";
    $array1b[0] = "Bases Datos";
    $array1b[1] = "Entornos Desarrollo";
    $array1b[2] = "Programación";
    $array1c[0] = "Bases Datos";
    $array1c[1] = "Entornos Desarrollo";
    $array1c[2] = "Programación";
    $array2[0] = "Sistemas Informáticos";
    $array2[1] = "FOL";
    $array2[2] = "Mecanizado";
    $array3[0] = "Desarrollo Web ES";
    $array3[1] = "Desarrollo Web EC";
    $array3[2] = "Despliegue";
    $array3[3] = "Desarrollo Interfaces";
    $array3[4] = "Inglés";

    echo "<h1>A.-</h1>";

    $indice = 2;

    foreach ($array2 as $a2) {
        $array1a[$variable] = $a2;
        $variable += 1;
    }
    foreach ($array3 as $a3) {
        $array1a[$variable] = $a3;
        $variable += 1;
    }

    foreach($array1a as $a1) {
        print ("<p>". $a1 ."</p>");
    }

    echo "<h1>B.-</h1>";

    $ArrayMerge = array_merge($array1b,$array2,$array3);

    foreach($ArrayMerge as $a1) {
        print ("<p>". $a1 ."</p>");
    }

    echo "<h1>C.-</h1>";

    foreach ($array2 as $a2) {
        array_push($array1c, $a2);
    }

    foreach ($array3 as $a3) {
        array_push($array1c, $a3);
    }

    foreach($array1c as $a1) {
        print ("<p>". $a1 ."</p>");
    }

?>
</BODY>
</HTML>
