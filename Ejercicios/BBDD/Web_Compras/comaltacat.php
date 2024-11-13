<HTML>
    <?php include_once "funciones_comaltacat.php" ?>
    <H1>Ejercicio 1 Web Empleados</H1>
    <BODY>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            Nombre de la Categoria : <input type="text" name="categoria" required><br>
            <input type="submit" value="enviar">
            <input type="reset" value="borrar">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $categoria = recogerDatos();
                insertarEmpleado($dni,$nombre,$fecha,$salario,$dept);
            }
        ?>
</BODY>
</HTML>