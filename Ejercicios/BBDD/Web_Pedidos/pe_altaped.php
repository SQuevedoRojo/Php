<?php 
    include_once "funciones_session.php";
    include_once "funciones_altaped.php";
    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSession();
    }
?>
<html>
    <head><title>Alta de Pedidos</title>
    <style>
        #pedido
        {
            position: absolute;
            top: 0;
            left: 80%;
        }
    </style></head>
    <body>
        <h2>Alta de Pedidos</h2>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <select name="productos"><?php imprimirProductos() ?></select>
            Cantidad : <input type="text" name="cantidad"><br>
            <input type="submit" value="Cerrar Sesion" name="cerrarSesion"><br>
            <input type="submit" value="Añadir Al Pedido" name="anadirPedido"><br>
            <input type="submit" value="Mostrar Pedido" name="mostrarPedido"><br>
            <input type="submit" value="Eliminar Pedido" name="eliminarPedido"><br>
            <input type="submit" value="Volver" name="volver"><br>
            <input type="submit" value="Realizar Pedido" name="realizarPedido">
        </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(isset($_POST["cerrarSesion"]))
            {
                if(verificarSessionExistente())
                    eliminarSession();
            }
            if(isset($_POST["anadirPedido"]))
            {
                list($producto,$cantidad) = recogerDatos();
                annadirAlPedido($producto,$cantidad);
            }
            if(isset($_POST["mostrarPedido"]))
            {
                imprimirPedido();
            }
            if(isset($_POST["eliminarPedido"]))
            {
                eliminarPedido();
            }
            if(isset($_POST["realizarPedido"]))
            {
                realizarPedido();
                header("Refresh: 5");
            }
            if(isset($_POST["volver"]))
            {
                header("Location: pe_inicio.php");
            }
        }
    ?>
    </body>
</html>