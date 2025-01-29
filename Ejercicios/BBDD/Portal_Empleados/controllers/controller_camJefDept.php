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

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $jefe = $_POST["jefes"];
        $empleado = $_POST["empleados"];
        $camposEmp = explode("|",$empleado);
        $numEmp = $camposEmp[0];
        $deptEmp = $camposEmp[1];
        $camposJefe = explode("|",$jefe);
        $numJefe = $camposJefe[0];
        $deptJefe = $camposJefe[1];
        if($deptEmp != $deptJefe)
        {
            trigger_error("No Se Puede Cambiar el Jefe de Departamento Porque Trabajan en Diferentes Departamentos");
        }
        else
        {
            require_once ("../db/db.php");
            require_once ("../models/model_camJefDept.php");
            cambiarJefeDepartamento($numEmp,$deptEmp,$numJefe,$deptJefe);
            print "<h2>Empleado Cambiado de Departamento</h2>";
            header("Refresh: 2");
        }

    }

    require_once ("../db/db.php");
    require_once ("../models/model_camJefDept.php");
    $empleados = saberEmpleadosExistentes();
    $jefes = saberJefesExistentes();
    require_once ("../views/view_camJefDept.php");

?>