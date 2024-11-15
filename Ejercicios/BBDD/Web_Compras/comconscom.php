<HTML>
    <?php include_once "funciones_comconscom.php" ?>
    <H1>Ejercicio 7 Web Empleados</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <select name="clientes"><?php imprimirClientes() ?></select><br>
            Fecha Inicio : <input type="text" name="fec_inic" placeholder="YYYY-MM-DD"><br>
            Fecha Final : <input type="text" name="fec_fin" placeholder="YYYY-MM-DD"><br>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                list($clientes,$fechaInicio,$fechaFinal) = recogerDatos();
                mostrarCompras($clientes,$fechaInicio,$fechaFinal);
            }
        ?>
</BODY>
</HTML>