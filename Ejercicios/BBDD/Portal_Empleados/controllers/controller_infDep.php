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
        $departamento = $_POST["departamentos"];
        require_once ("../db/db.php");
        require_once ("../models/model_infDep.php");
        list($jefe,$empleadosTrabajando,$empleadosCambiados) = saberInformacionDepartamento($departamento);
    }

    require_once ("../db/db.php");
    require_once ("../models/model_infDep.php");
    $departamentos = saberDepartamentosExistentes();
    require_once ("../views/view_infDep.php");

?>