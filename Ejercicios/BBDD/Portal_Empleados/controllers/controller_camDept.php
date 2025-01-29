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
        $empleDept = $_POST["empleados"];
        $deptNue = $_POST["departamentos"];
        $campos = explode("|",$empleDept);
        $emple = $campos[0];
        $deptAnt = $campos[1];
        if($deptAnt == $deptNue)
        {
            trigger_error("No Se Puede Cambiar Al Mismo Departamento");
        }
        else
        {
            require_once ("../db/db.php");
            require_once ("../models/model_camDept.php");
            cambiarDepartamento($emple,$deptAnt,$deptNue);
            print "<h2>Empleado Cambiado de Departamento</h2>";
            header("Refresh: 2");
        }

    }

    require_once ("../db/db.php");
    require_once ("../models/model_camDept.php");
    $empleados = saberEmpleadosExistentes();
    $departamentos = saberDepartamentosExistentes();
    require_once ("../views/view_camDept.php");

?>