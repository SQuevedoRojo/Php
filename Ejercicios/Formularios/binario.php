<?php
    $num = $_REQUEST['num'];
    $resultado = decbin($num);

    echo "El binario de ".$num." es ".$resultado;
?>