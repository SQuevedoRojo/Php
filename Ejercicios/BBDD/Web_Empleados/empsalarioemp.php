<HTML>
    <?php include_once "funciones_empsalarioemp.php" ?>
    <H1>Ejercicio 6 BBDD</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <label>Empleado :</label>
            <select name="empleados">
                <?php imprimirEmpleados(); ?>
            </select>
            <br>
            <label>Porcentaje Salario : </label><input type="text" name="salario">
            <br> 
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                list($empleado,$porcentajeSalario) = recogerDatos();
                cambiarSalario($empleado,$porcentajeSalario);
            }
        ?>
</BODY>
</HTML>