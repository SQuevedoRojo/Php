<HTML>
<HEAD><TITLE> EJ7A</TITLE></HEAD>
<BODY>
<?php
    $alumnos = array("Asier" => 19,"Joel" => 18, "William" => 21, "Quevedo" => 18,"Hugo" => 21);

    echo "<h1>A.- </h1>";

    foreach ($alumnos as $x => $y) {
        print ("<p> Alumno : ". $x ." | Edad : ". $y ."</p>");
    }

    echo "<h1>B.- </h1>";

    $indice = 1;

    print ("<p>". $alumnos[array_keys($alumnos)[$indice]] ."</p>");

    echo "<h1>C.- </h1>";

    $indice += 1;

    print ("<p>". $alumnos[array_keys($alumnos)[$indice]] ."</p>");

    echo "<h1>D.- </h1>";

    $indice = count($alumnos) - 1;

    print ("<p>". $alumnos[array_keys($alumnos)[$indice]] ."</p>");

    echo "<h1>E.- </h1>";

    asort($alumnos);

    $indice = 0;

    print ("<p>". $alumnos[array_keys($alumnos)[$indice]] ."</p>");

    $indice = count($alumnos) - 1;

    print ("<p>". $alumnos[array_keys($alumnos)[$indice]] ."</p>");

?>
</BODY>
</HTML>
