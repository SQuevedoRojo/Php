<HTML>
    <?php include_once "funciones_comaprpro.php" ?>
    <H1>Ejercicio 4 Web Empleados</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            Cantidad de Producto : <input type="number" name="cantidadProducto" required><br>
            <select name="productos"><?php imprimirProductos() ?></select>
            <select name="almacenes"><?php imprimirAlmacenes() ?></select>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                list($cantidadProductos,$producto,$almacen) = recogerDatos();
                insertarProductosEnAlmacen($cantidadProductos,$producto,$almacen);
            }
        ?>
</BODY>
</HTML>