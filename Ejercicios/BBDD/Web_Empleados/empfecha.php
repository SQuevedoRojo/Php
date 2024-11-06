<HTML>
    <?php include_once "funciones_empfecha.php" ?>
    <H1>Ejercicio 7 BBDD</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <label>Fecha :</label><input type="text" name="fecha" placeholder="AÑO-MES-DIA">
            <br> 
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $fecha = recogerDatos();
                mostrarTrabajadoresFecha($fecha);
            }
        ?>
</BODY>
</HTML>