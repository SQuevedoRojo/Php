<?php
    $num1 = $_REQUEST['num1'];
    $num2 = $_REQUEST['num2'];
    $operacion = $_REQUEST['operacion'];
    $resultado = 0;

    operacion($operacion,$num1,$num2);

    function operacion($operacion,$num1,$num2)
    {
        switch ($operacion) {
            case '+':
                $resultado = $num1 + $num2;
                break;
            case '-':
                $resultado = $num1 - $num2;
                break;
            case '*':
                $resultado = $num1 * $num2;
                break;
            case '/':
                $resultado = $num1 / $num2;
                break;
        }
        imprimir($num1,$num2,$operacion,$resultado);
    }

    function imprimir($num1,$num2,$operacion,$resultado)
    {
        echo "El resultado de ".$num1." ".$operacion." ".$num2." = ".$resultado;
    }
?>