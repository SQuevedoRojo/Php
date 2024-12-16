<?php 
    include_once "funciones_constock.php";
    include_once "funciones_session.php";
    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSession();
    }
?>
<html>
    <head><title>Consultar Stock de Tipo de Producto</title></head>
    <body>
        <h2>Consultar Stock de Tipo de Producto</h2>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <select name="tipoProductos"><?php imprimirTipoProductos() ?></select>
            <input type="submit" value="Mostrar Informacion" name="mostrarInfo"><br>
            <input type="submit" value="Cerrar Sesion" name="cerrarSesion"><br>
        </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(isset($_POST["mostrarInfo"]))
            {
                $tipoProducto = recogerDatos();
                mostrarInformacionTipoProducto($tipoProducto);
            }
            if(isset($_POST["cerrarSesion"]))
            {
                if(verificarSessionExistente())
                    eliminarSession();
            }
        }
    ?>
    </body>
</html>