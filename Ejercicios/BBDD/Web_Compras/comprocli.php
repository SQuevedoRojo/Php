<HTML>
    <?php include_once "funciones_comprocli.php" ?>
    <H1>Ejercicio 12 Web Empleados</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            Producto a comprar : <select name="productos"><?php imprimirProductos() ?></select>
            Unidades : <input type="text" name="unidades"><br>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                list($productos,$unidades) = recogerDatos();
                verificarCliente($usuario,$contrasena);
            }
        ?>
</BODY>
</HTML>