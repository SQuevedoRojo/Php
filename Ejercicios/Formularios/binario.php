<?php
    $num = $_REQUEST['num'];
    $resultado = decbin($num);

    print "Numero decimal :<input type='number' name='num' value='$num'><br>";
    print "Numero Binario :<input type='number' name='numBin' value='$resultado'><br>";
?>