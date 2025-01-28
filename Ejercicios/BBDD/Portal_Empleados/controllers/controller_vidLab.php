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
        list($infoPersonal,$salario,$titulaciones,$departamentos) = saberVidaLaboral($empleado);
        var_dump($infoPersonal);
        var_dump($salario);
        var_dump($titulaciones);
        var_dump($departamentos);
        imprimirVidaLaboral($infoPersonal,$salario,$titulaciones,$departamentos);
    }

    function imprimirVidaLaboral($infoPersonal,$salario,$titulaciones,$departamentos)
    {
        null;
    }

    require_once ("../db/db.php");
    require_once ("../models/model_vidLab.php");
    $empleados = saberEmpleadosExistentes();
    require_once ("../views/view_visLab.php");
?>