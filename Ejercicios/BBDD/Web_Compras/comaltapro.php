<HTML>
    <?php include_once "funciones_comaltapro.php" ?>
    <H1>Ejercicio 2 Web Empleados</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            Nombre del Producto : <input type="text" name="nombreProducto" required><br>
            Precio del Producto : <input type="number" name="precioProducto" required><br>
            <select name="categoriaProducto">
                <?php imprimirCategorias() ?>
            </select>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                list($nombreProducto,$precioProducto,$categoriaProducto) = recogerDatos();
                insertarProducto($nombreProducto,$precioProducto,$categoriaProducto);
            }
        ?>
</BODY>
</HTML>