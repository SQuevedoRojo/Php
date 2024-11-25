<HTML>
    <?php include_once "funciones_comprocli.php" ?>
    <H1>Ejercicio 12 Web Empleados</H1>
    <style>
        #carrito
        {
            position: absolute;
            top: 0;
            left: 80%;
        }
    </style>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            Producto a comprar : <select name="productos"><?php imprimirProductos() ?></select>
            Unidades : <input type="text" name="unidades"><br>
            <input type="submit" value="Añadir Producto" name="annadirProducto">
            <input type="reset" value="borrar">
            <br>
            <input type="submit" value="Comprar Cesta Compra" name="comprarProductos">
            
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if(isset($_POST['annadirProducto']))
                {
                    list($productos,$unidades) = recogerDatos();
                    annadirCestaCompra($productos,$unidades);
                }
            }
        ?>
        <?php imprimirCestaCompra(); ?>
</BODY>
</HTML>