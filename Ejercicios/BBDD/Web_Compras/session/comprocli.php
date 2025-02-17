<HTML>
    <?php include_once "funciones_comprocli.php";
    include_once "funcion_session.php";
    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSession();
        header("Location: ./comlogincli.php");
    }
    ?>
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
            <br>
            <input type="submit" value="Eliminar Cesta Compra" name="eliminarCesta">
            <br>
            <input type="submit" value="Cerrar Sesion" name="cerrarSesion">
            <?php imprimirCestaCompra(); ?>
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if(isset($_POST['annadirProducto']))
                {
                    list($productos,$unidades) = recogerDatos();
                    annadirCestaCompra($productos,$unidades);
                    header("Refresh:0");
                }
                if(isset($_POST['comprarProductos']) && ( isset($_SESSION["cestaCompra"]) && $_SESSION["cestaCompra"] != null))
                {
                    comprarProductos();
                    header("Refresh:3");
                }
                if(isset($_POST["eliminarCesta"]))
                {
                    eliminarCestaCompra();
                    header("Refresh:0");
                }
                if(isset($_POST['cerrarSesion']))
                {
                    eliminarSession();
                }
            }
        ?>
        <?php  ?>
</BODY>
</HTML>