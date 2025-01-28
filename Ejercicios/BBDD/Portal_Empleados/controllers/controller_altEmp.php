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
        $nombre = limpiar($_POST["nombre"]);
        $apellido = limpiar($_POST["apellido"]);
        $fecNac = limpiar($_POST["fecNac"]);
        $genero = limpiar($_POST["genero"]);
        $salario = limpiar($_POST["sal"]);
        $departamento = $_POST["departamento"];
        $cargo = $_POST["cargo"];
        require_once ("../models/model_altEmp.php");
        altaEmpleado($nombre,$apellido,$fecNac,$salario,$genero,$departamento,$cargo);
        print "<h2>Empleado Dado de Alta</h2>";
        header("Refresh: 2");
    }
    require_once ("../db/db.php");
    require_once ("../models/model_altEmp.php");
    $departamentos = saberDepartamentos();
    $cargos = saberCargos();
    require_once ("../views/view_altEmp.php");
?>