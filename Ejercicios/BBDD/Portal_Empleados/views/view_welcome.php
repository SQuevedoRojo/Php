<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Inicio</title>
</head>
<body>
    <?php
    if($dept == "d003")
    {
        print "<ol><a href='controller_altEmp.php'><li>Alta Empleado</li></a><a href='controller_altEmpMas.php'><li>Alta Masiva Empleados</li></a><a href='controller_modSal.php'><li>Modificar salario</li></a><a href='controller_vidLab.php'><li>Vida laboral</li></a><a href='controller_infDep.php'><li>Info departamentos</li></a><a href='controller_camDept.php'><li>Cambio departamento</li></a><a href='controller_camJefDept.php'><li>Nuevo Jefe Departamento</li></a><a href='controller_bajaEmp.php'><li>Baja empleado</li></a><a href='controller_miNomina.php'><li>Mi nómina</li></a><li>Historial laboral</li></ol>";
    }
    else
    {
        print "<ol><a href='controller_miNomina.php'><li>Mi nómina</li></a><li>Historial laboral</li></ol>";
    }
    ?>
</body>
</html>