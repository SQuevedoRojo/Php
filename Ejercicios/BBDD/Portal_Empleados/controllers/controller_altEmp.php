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

    require_once ("../models/model_altEmp.php");
    $departamentos = saberDepartamentos();
    $cargos = saberCargos();
    require_once ("../views/view_altEmp.php");
?>