<HTML>
<HEAD><TITLE> EJ6A</TITLE></HEAD>
<BODY>
<?php
    $array1 = array("Bases Datos","Entornos Desarrollo","Programación");
    $array2 = array("Sistemas Informáticos","FOL","Mecanizado");
    $array3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces","Inglés");


    $ArrayMerge = array_merge($array1,$array2,$array3);

    $indice = "";
    
    if (in_array("Mecanizado",$ArrayMerge))
    {
        $indice = array_search("Mecanizado",$ArrayMerge);
        unset($ArrayMerge[$indice]);
    }

    
    $arrayInverso = array_reverse($ArrayMerge);

    foreach ($arrayInverso as $a) {
        print("<p>". $a ."</p>");
    }
?>
</BODY>
</HTML>
