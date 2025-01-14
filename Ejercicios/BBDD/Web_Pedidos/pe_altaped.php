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
            <input type="submit" value="Realizar Pedido" name="realizarPedido"><br>
            <input type="submit" value="Volver" name="volver"><br>
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
                list($parametros,$firma) = realizarPedido();
            ?>
            <form style="opacity: 0;" name="from" id="formularioPago" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST">
                <input type="hidden" name="Ds_SignatureVersion" value="HMAC_SHA256_V1"/>
                <input type="hidden" name="Ds_MerchantParameters" value="<?php echo $parametros; ?>"/>
                <input type="hidden" name="Ds_Signature" value="<?php echo $firma; ?>"/>	
            </form>
            <script>document.getElementById("formularioPago").submit();</script>
            <?php
            }
            if(isset($_POST["volver"]))
            {
                header("Location: pe_inicio.php");
            }
        }
    ?>
    </body>
</html>