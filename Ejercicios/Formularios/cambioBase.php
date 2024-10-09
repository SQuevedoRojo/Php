<?php
    $num = limpiar($_REQUEST['num']);
    $operacion = $_REQUEST['base'];

    print "Numero Decimal : <input type='number' name='num' value='$num'><br>";

    switch ($operacion) {
        case 'binario':
            print "<table border='1'>";
            print "<tr><th>Binario</th><th>".decbin($num)."</th></tr>";
            print "</table>";
            break;
        case 'octal':
            print "<table border='1'>";
            print "<tr><th>Octal</th><th>".decoct($num)."</th></tr>";
            print "</table>";
            break;
        case 'hexadecimal':
            print "<table border='1'>";
            print "<tr><th>Hexadecimal</th><th>".dechex($num)."</th></tr>";
            print "</table>";
            break;
        case 'todos':
            print "<table border='1'>";
            print "<tr><th>Binario</th><th>".decbin($num)."</th></tr>";
            print "<tr><th>Octal</th><th>".decoct($num)."</th></tr>";
            print "<tr><th>Hexadecimal</th><th>".dechex($num)."</th></tr>";
            print "</table>";
            break;
    }

    function limpiar($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
?>