<HTML>
    <?php include_once "funciones_comconsalm.php" ?>
    <H1>Ejercicio 6 Web Empleados</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <select name="almacenes"><?php imprimirAlmacenes() ?></select><br>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $almacen = recogerDatos();
                MostrarAlmacen($almacen);
            }
        ?>
</BODY>
</HTML>