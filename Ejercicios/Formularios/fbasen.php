<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Base Especifica</title>
</head>
<body>
    <h1>Base Especifica</h1>
    <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
        Numero :<input type="text" name="num"><br>
        Nueva Base :<input type="number" name="base"><br>
        <input type="submit" value="enviar">
        <input type="reset" value="borrar">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num = substr($_REQUEST['num'],0,strpos($_REQUEST['num'],'/'));
        $baseOriginal = substr($_REQUEST['num'],strpos($_REQUEST['num'],'/')+1,strlen($_REQUEST['num']));
        $baseNueva = limpiar($_REQUEST['base']);

        echo "EL numero " . $num . " en base " . $baseOriginal . " es " . base_convert($num,$baseOriginal,$baseNueva) . " en la base " . $baseNueva ;

        
    }
    function limpiar($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
</body>
</html>