<HTML>
    <?php include_once "funciones_empaltaemp.php" ?>
    <H1>Ejercicio 2 BBDD</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            DNI : <input type="text" name="dni" required><br>
            Nombre Empleado : <input type="text" name="nombre_emple" required><br>
            Fecha Nacimiento : <input type="text" name="fecha_nac" required><br>
            Salario : <input type="text" name="salario" required><br>
            <select name="departamentos">
                <?php imprimirDepartamentos() ?>
            </select>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                list($dni,$nombre,$fecha,$salario,$dept) = recogerDatos();
                insertarEmpleado($dni,$nombre,$fecha,$salario,$dept);
            }
        ?>
</BODY>
</HTML>