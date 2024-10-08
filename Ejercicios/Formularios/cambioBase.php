<?php
    $num = limpiar($_REQUEST['num']);
    $operacion = $_REQUEST['base'];

    switch ($operacion) {
        case 'binario':
            echo "El ".$num." en binario es ". decbin($num);
            break;
        case 'octal':
            echo "El ".$num." en octal es ". decoct($num);
            break;
        case 'hexadecimal':
            echo "El ".$num." en hexadecimal es ". dechex($num);
            break;
        case 'todos':
            echo "El ".$num." en binario es ". decbin($num);
            echo "El ".$num." en octal es ". decoct($num);
            echo "El ".$num." en hexadecimal es ". dechex($num);
            break;
    }

    function limpiar($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
?>