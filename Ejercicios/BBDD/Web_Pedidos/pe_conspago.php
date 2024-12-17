<?php 
    include_once "funciones_conspago.php";
    include_once "funciones_session.php";
    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSession();
    }
?>
<html>
    <head><title>Consultar Informacion Pago Clientes</title></head>
    <body>
        <h2>Consultar Informacion Pago Clientes</h2>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            Fecha Inicio : <input type="text" name="fecha1" placeholder="año-mes-dia"><br>
            Fecha Final : <input type="text" name="fecha2" placeholder="año-mes-dia"><br>
            <input type="submit" value="Mostrar Informacion" name="mostrarInfo"><br>
            <input type="submit" value="Cerrar Sesion" name="cerrarSesion"><br>
            <input type="submit" value="Volver" name="volver"><br>
        </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(isset($_POST["mostrarInfo"]))
            {
                list($fecha1,$fecha2) = recogerDatos();
                mostrarInformacionPago($fecha1,$fecha2);
            }
            if(isset($_POST["cerrarSesion"]))
            {
                if(verificarSessionExistente())
                    eliminarSession();
            }
            if(isset($_POST["volver"]))
            {
                header("Location: pe_inicio.php");
            }
        }
    ?>
    </body>
</html>