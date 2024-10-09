<?php
    $num1 = $_REQUEST['num1'];
    $num2 = $_REQUEST['num2'];
    $operacion = $_REQUEST['operacion'];
    $resultado = 0;

    switch ($operacion) {
        case '+':
            $resultado = $num1 + $num2;
            imprimir($num1,$num2,$operacion,$resultado);
            break;
        case '-':
            $resultado = $num1 - $num2;
            imprimir($num1,$num2,$operacion,$resultado);
            break;
        case '*':
            $resultado = $num1 * $num2;
            imprimir($num1,$num2,$operacion,$resultado);
            break;
        case '/':
            $resultado = $num1 / $num2;
            imprimir($num1,$num2,$operacion,$resultado);
            break;
    }

    function imprimir($num1,$num2,$operacion,$resultado)
    {
        echo "El resultado de ".$num1." ".$operacion." ".$num2." = ".$resultado;
    }
?>