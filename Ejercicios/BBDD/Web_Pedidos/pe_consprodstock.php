<?php 
    include_once "funciones_consprodstock.php";
?>
<html>
    <head><title>Alta de Pedidos</title></head>
    <body>
        <h2>Alta de Pedidos</h2>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <select name="productos"><?php imprimirProductos() ?></select>
            <input type="submit" value="Mostrar Informacion" name="mostrarInfo"><br>
        </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $producto = recogerDatos();
            mostrarInformacionProducto($producto);
        }
    ?>
    </body>
</html>