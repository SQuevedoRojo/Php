<?php 
    include_once "funciones_topprod.php";
    include_once "funciones_session.php";
    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSession();
    }
?>
<html>
    <head><title>Alta de Pedidos</title></head>
    <body>
        <h2>Alta de Pedidos</h2>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            Fecha Inicio : <input type="text" name="fecha1" placeholder="año-mes-dia"><br>
            Fecha Final : <input type="text" name="fecha2" placeholder="año-mes-dia"><br>
            <input type="submit" value="Mostrar Informacion" name="mostrarInfo"><br>
            <input type="submit" value="Cerrar Sesion" name="cerrarSesion"><br>
        </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(isset($_POST["mostrarInfo"]))
            {
                list($fecha1,$fecha2) = recogerDatos();
                mostrarInformacionProductosVendidos($fecha1,$fecha2);
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