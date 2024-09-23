<HTML>
<HEAD><TITLE> EJ5A</TITLE></HEAD>
<BODY>
<?php
    $array1a = array("Bases Datos","Entornos Desarrollo","Programación");
    $array1b = array("Bases Datos","Entornos Desarrollo","Programación");
    $array1c = array("Bases Datos","Entornos Desarrollo","Programación");
    $array2 = array("Sistemas Informáticos","FOL","Mecanizado");
    $array3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces","Inglés");


    echo "<h1>A.-</h1>";

    $indice = 2;

    foreach ($array2 as $a2) {
        $array1a[$indice] = $a2;
        $indice += 1;
    }
    foreach ($array3 as $a3) {
        $array1a[$indice] = $a3;
        $indice += 1;
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
