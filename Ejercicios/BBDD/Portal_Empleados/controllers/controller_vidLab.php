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
        require_once ("../models/model_vidLab.php");
        list($infoPersonal,$salario,$titulaciones,$departamentos) = saberVidaLaboral($empleado);
    }

    require_once ("../db/db.php");
    require_once ("../models/model_vidLab.php");
    $empleados = saberEmpleadosExistentes();
    require_once ("../views/view_vidLab.php");
?>