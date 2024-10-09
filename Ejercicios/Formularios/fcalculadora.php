<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calculadora</title>
</head>
<body>
    <h1>Calculadora</h1>
    <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
        Operando1:<input type="number" name="num1"><br>
        Operando2:<input type="number" name="num2"><br>
        Operacion:<select name="operacion">
            <option value="+">suma</option>
            <option value="-">resta</option>
            <option value="*">multiplicacion</option>
            <option value="/">division</option>
        </select>
        <input type="submit" value="enviar">
        <input type="reset" value="borrar">
    </form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    }
?>
</body>
</html>