<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");    
    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: ../index.php");
    }
    var_dump($_SESSION);

    $dept = devolverDept();

    if($dept == "d003")
    {
        print "<ol><a href='controller_altEmp.php'><li>Alta Empleado</li></a><a href='controller_altEmpMas.php'><li>Alta Masiva Empleados</li></a><li>Modificar salario</li><li>Vida laboral</li><li>Info departamentos</li><li>Cambio departamento</li><li>Nuevo jefe departamento</li><li>Baja empleado</li><li>Mi nómina</li><li>Historial laboral</li></ol>";
    }
    else
    {
        print "<ol><li>Mi nómina</li><li>Historial laboral</li></ol>";
    }
    
?>