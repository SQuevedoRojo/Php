<HTML>
    <?php include_once "funciones_comconscli.php";
    include_once "funcion_session.php";
    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSession();
        header("Location: ./comlogincli.php");
    }
    ?>
    <H1>Ejercicio 13 Web Empleados</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            Fecha Inicio : <input type="text" name="fec_inic" placeholder="YYYY-MM-DD"><br>
            Fecha Final : <input type="text" name="fec_fin" placeholder="YYYY-MM-DD"><br>
            <input type="submit" value="Mostrar Compras" name="mostrarCompras">
            <input type="reset" value="borrar">
            <br>
            <input type="submit" value="Cerrar Sesion" name="cerrarSesion">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if(isset($_POST['mostrarCompras']))
                {
                    list($clientes,$fechaInicio,$fechaFinal) = recogerDatos();
                    mostrarCompras($clientes,$fechaInicio,$fechaFinal);
                }
                if(isset($_POST['cerrarSesion']))
                {
                    eliminarSession();
                }
            }
        ?>
</BODY>
</HTML>