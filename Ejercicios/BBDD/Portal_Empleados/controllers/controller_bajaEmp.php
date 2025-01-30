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
        $empleado = $_POST["empleados"];
        require_once ("../db/db.php");
        require_once ("../models/model_bajaEmp.php");
        darBajaEmpleado($emp);
        print "<h2>Empleado Dado de Baja</h2>";
        header("Refresh: 2");
    }

    require_once ("../db/db.php");
    require_once ("../models/model_bajaEmp.php");
    $empleados = saberEmpleadosExistentes();
    require_once ("../views/view_bajaEmp.php");

?>