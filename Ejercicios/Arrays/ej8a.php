<HTML>
<HEAD><TITLE> EJ8A</TITLE></HEAD>
<BODY>
<?php
    $alumnos = array("Asier" => 7,"Joel" => 8, "William" => 7, "Quevedo" => 10,"Hugo" => 6);

    echo "<h1>A.- </h1>";

    arsort($alumnos);

    print ("<p>". reset($alumnos) ."</p>");

    echo "<h1>A.- </h1>";

    print ("<p>". end($alumnos) ."</p>");

    echo "<h1>C.-</h1>";

    $notaMedia = 0;

    foreach ($alumnos as $nombre => $nota) {
        $notaMedia += $nota;
    }

    $notaMedia /= count($alumnos);

    print("<p>La nota media es ". $notaMedia ."</p>");

?>
</BODY>
</HTML>
