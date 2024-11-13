<HTML>
    <?php include_once "funciones_comaltacli.php" ?>
    <H1>Ejercicio 8 Web Empleados</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            Nif : <input type="text" name="nif"><br>
            Nombre : <input type="text" name="nombre"><br>
            Apellido : <input type="text" name="apellidos"><br>
            Codigo Postal : <input type="number" name="codPos"><br>
            Dirección : <input type="text" name="direccion"><br>
            Ciudad : <input type="text" name="ciudad"><br>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                list($nif,$nombre,$apellidos,$codPostal,$direccion,$ciudad) = recogerDatos();
                insertarCliente($nif,$nombre,$apellidos,$codPostal,$direccion,$ciudad);
            }
        ?>
</BODY>
</HTML>