<HTML>
    <?php include_once "funciones_signup.php" ?>
    <H1>Ejercicio 11 Web Empleados</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            Nombre de Usuario : <input type="text" name="nombreUsu"><br>
            Nombre : <input type="text" name="nombre"><br>
            Apellido : <input type="text" name="apellido"><br>
            Telefono : <input type="text" name="tel"><br>
            Direccion 1 : <input type="text" name="dir1"><br>
            Ciudad : <input type="text" name="ciudad"><br>
            Pais : <input type="text" name="pais"><br>
            <input type="submit" value="Registrarse">
            <input type="reset" value="Borrar Datos">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                list($usuario,$nombre,$ape,$tel,$dir1,$ciudad,$pais) = recogerDatos();
                registrarCliente($usuario,$nombre,$ape,$tel,$dir1,$ciudad,$pais);
            }
        ?>
</BODY>
</HTML>