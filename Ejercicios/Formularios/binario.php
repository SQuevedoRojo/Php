<?php
    $num = limpiar($_REQUEST['num']);
    $resultado = decbin($num);

    imprimir($num,$resultado);

    function limpiar($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function imprimir($num,$resultado)
    {
        print "Numero decimal :<input type='number' name='num' value='$num'><br>";
        print "Numero Binario :<input type='number' name='numBin' value='$resultado'><br>";
    }

    
?>