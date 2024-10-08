<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Binario</title>
</head>
<body>
    <h1>Calculadora de Binarios</h1>
    <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
        Numero decimal :<input type="number" name="num"><br>
        <input type="submit" value="enviar">
        <input type="reset" value="borrar">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $num = $_REQUEST['num'];
            $resultado = decbin($num);

            print "Numero decimal :<input type='number' name='num' value='$num'><br>";
            print "Numero Binario :<input type='number' name='numBin' value='$resultado'><br>";
        }
    ?>
</body>
</html>