<HTML>
    <?php include_once "funciones_comconstock.php" ?>
    <H1>Ejercicio 5 Web Empleados</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <select name="productos"><?php imprimirProductos() ?></select><br>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $producto = recogerDatos();
                MostrarProductosEnAlmacen($producto);
            }
        ?>
</BODY>
</HTML>