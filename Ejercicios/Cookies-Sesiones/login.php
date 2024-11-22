<?php
    include_once "funciones_login.php";
?>
<HTML>
    <H1>Ejercicio 8 Web Empleados</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            Usuarios : <input type="text" name="usuario"><br>
            Contraseña : <input type="text" name="contrasena"><br>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                list($usuario,$contraseña) = recogerDatos();
                verificarCuenta($usuario,$contraseña);
            }
        ?>
</BODY>
</HTML>