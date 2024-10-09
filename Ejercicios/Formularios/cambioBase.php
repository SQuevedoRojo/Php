<?php
    $num = limpiar($_REQUEST['num']);
    $operacion = $_REQUEST['base'];

    operacion($operacion,$num);

    function operacion($operacion,$num)
    {
        $tipo = 0;;
        switch ($operacion) {
            case 'binario':
                $tipo = 1;
                break;
            case 'octal':
                $tipo = 2;
                break;
            case 'hexadecimal':
                $tipo = 3;
                break;
            case 'todos':
                $tipo = 4;
                break;
        }
        imprimir($num,$tipo);
    }

    function limpiar($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      function imprimir($num,$tipo)
      {
        print "Numero Decimal : <input type='number' name='num' value='$num'><br>";
        print "<table border='1'>";
        switch ($tipo) {
            case 1:
                print "<tr><th>Binario</th><th>".decbin($num)."</th></tr>";
                break;
            case 2:
                print "<tr><th>Octal</th><th>".decoct($num)."</th></tr>";
                break;
            case 3:
                print "<tr><th>Hexadecimal</th><th>".dechex($num)."</th></tr>";
                break;
            case 4:
                print "<tr><th>Binario</th><th>".decbin($num)."</th></tr>";
                print "<tr><th>Octal</th><th>".decoct($num)."</th></tr>";
                print "<tr><th>Hexadecimal</th><th>".dechex($num)."</th></tr>";
                break;
        }
        print "</table>";
      }
?>