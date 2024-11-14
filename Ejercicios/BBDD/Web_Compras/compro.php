<HTML>
    <?php include_once "funciones_compro.php" ?>
    <H1>Ejercicio 9 Web Empleados</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            Cliente : <select name="clientes"><?php imprimirClientes() ?></select>
            Producto a comprar : <select name="productos"><?php imprimirProductos() ?></select>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                list($cliente,$producto) = recogerDatos();
                comprarProducto($cliente,$producto);
            }
        ?>
</BODY>
</HTML>