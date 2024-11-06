<HTML>
    <?php include_once "funciones_emphistdpto.php" ?>
    <H1>Ejercicio 5 BBDD</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <label>Departamento :</label>
            <select name="departamento">
                <?php imprimirDepartamentos(); ?>
            </select>
            <br>
            <label> Empleado :</label>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $dept = recogerDatos();
                listarHistoricoEmpleado($dept);
            }
        ?>
</BODY>
</HTML>