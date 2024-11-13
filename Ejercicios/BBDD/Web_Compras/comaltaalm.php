<HTML>
    <?php include_once "funciones_comaltaalm.php" ?>
    <H1>Ejercicio 3 Web Empleados</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            Localidad : <input type="text" name="localidad" required><br>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $localidad = recogerDatos();
                insertarProducto($nombreProducto,$precioProducto,$categoriaProducto);
            }
        ?>
</BODY>
</HTML>