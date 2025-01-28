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
        $salario = intval($_POST["sal"]);
        require_once ("../db/db.php");
        require_once ("../models/model_modSal.php");
        modificarSalario($empleado,$salario);
        print "<h2>Salario Modificado</h2>";
        header("Refresh: 2");
    }

    require_once ("../db/db.php");
    require_once ("../models/model_modSal.php");
    $empleados = saberEmpleadosExistentes();
    require_once ("../views/view_modSal.php");
?>