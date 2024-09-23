<HTML>
<HEAD><TITLE> EJ6A</TITLE></HEAD>
<BODY>
<?php
    $array1 = array();
    $array2 = array();
    $array3 = array();

    $array1[0] = "Bases Datos";
    $array1[1] = "Entornos Desarrollo";
    $array1[2] = "Programación";
    $array2[0] = "Sistemas Informáticos";
    $array2[1] = "FOL";
    $array2[2] = "Mecanizado";
    $array3[0] = "Desarrollo Web ES";
    $array3[1] = "Desarrollo Web EC";
    $array3[2] = "Despliegue";
    $array3[3] = "Desarrollo Interfaces";
    $array3[4] = "Inglés";


    $ArrayMerge = array_merge($array1,$array2,$array3);

    $indice = "";
    $encontrado = false;
    $indiceBucle = 0;
    while (!$encontrado && $indiceBucle < count($ArrayMerge)) { 
        if ($ArrayMerge[$indiceBucle] == "Mecanizado")
        {
            $indice = $indiceBucle;
            $encontrado = true;
        }
        $indiceBucle += 1;
    }

    unset($ArrayMerge[$indice]);

    $arrayInverso = array_reverse($ArrayMerge);

    foreach ($arrayInverso as $a) {
        print("<p>". $a ."</p>");
    }
?>
</BODY>
</HTML>
