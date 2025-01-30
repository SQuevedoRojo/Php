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
        $empleado = devolverId();
        require_once ("../db/db.php");
        require_once ("../models/model_histLabEmp.php");
        list($infoPersonal,$salario,$titulaciones,$departamentos) = saberVidaLaboral($empleado);
        if($infoPersonal[0]["fecha_baja"] == null)
            $baja = "NO";
        else
            $baja = $infoPersonal[0]["fecha_baja"];
    }
    require_once ("../views/view_histLabEmp.php");
?>