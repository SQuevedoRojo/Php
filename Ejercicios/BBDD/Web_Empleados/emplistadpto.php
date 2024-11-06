<HTML>
    <?php include_once "funciones_emplistadpto.php" ?>
    <H1>Ejercicio 4 BBDD</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <label>Departamento :</label>
            <select name="departamento">
                <?php imprimirDepartamentos(); ?>
            </select>
            <br>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
            <br><a href="empinicio.html">Menu Principal</a>
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $dept = recogerDatos();
                listarEmpleado($dept);
            }
        ?>
</BODY>
</HTML>