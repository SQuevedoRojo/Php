<HTML>
    <?php include_once "funciones_comlogincli.php" ?>
    <H1>Ejercicio 10 Web Empleados</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            Usuario : <input type="text" name="usuario"><br>
            Contraseña : <input type="text" name="contrasena"><br>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                list($usuario,$contrasena) = recogerDatos();
                verificarCliente($usuario,$contrasena);
            }
        ?>
</BODY>
</HTML>