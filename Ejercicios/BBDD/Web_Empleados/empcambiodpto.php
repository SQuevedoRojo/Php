<HTML>
    <?php include_once "funciones_empcambiodpto.php" ?>
    <H1>Ejercicio 3 BBDD</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <label>Departamento Anterior :</label>
            <select name="departamento_anterior">
                <?php imprimirDepartamentos(); ?>
            </select>
            <br>
            <label>Departamento Nuevo :</label>
            <select name="departamento_nuevo">
                <?php imprimirDepartamentos(); ?>
            </select>
            <br>
            <label>DNI Empleado :</label>
            <select name="empleados">
                <?php imprimirEmpleados(); ?>
            </select>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                list($dni,$deptAntiguo,$deptNuevo) = recogerDatos();
                cambiarEmpleado($dni,$nombre,$fecha,$salario,$dept);
            }
        ?>
</BODY>
</HTML>