<?php
    $num = limpiar($_REQUEST['num']);
    $operacion = $_REQUEST['base'];

    switch ($operacion) {
        case 'binario':
            echo "El ".$num1." en binario es ". decbin($num);
            break;
        case 'octal':
            echo "El ".$num1." en octal es ". decoct($num);
            break;
        case 'hexadecimal':
            echo "El ".$num1." en hexadecimal es ". dechex($num);
            break;
        case 'todos':
            echo "El ".$num1." en binario es ". decbin($num);
            echo "El ".$num1." en octal es ". decoct($num);
            echo "El ".$num1." en hexadecimal es ". dechex($num);
            break;
    }

    function limpiar($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
?>