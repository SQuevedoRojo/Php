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
        if(isset($_POST["cesta"]))
        {
            $nombre = limpiar($_POST["nombre"]);
            $apellido = limpiar($_POST["apellido"]);
            $fecNac = limpiar($_POST["fecNac"]);
            $genero = limpiar($_POST["genero"]);
            $salario = limpiar($_POST["sal"]);
            $departamento = $_POST["departamento"];
            $cargo = $_POST["cargo"];
            if($nombre == "" || $apellido == "" || $fecNac == "" || $genero == "" || $salario == "")
                trigger_error("Debe Introducir Todos Los Datos");
            else
            {
                $array = array("nombre" => $nombre,"ape" => $apellido,"fecNac" => $fecNac,"genero" => $genero,"sal" => $salario,"departamento" => $departamento,"cargo"=>$cargo);
                annadirEmpleadosALaCesta($array);
                print "<h2>Empleado Añadido a la Cesta</h2>";
            }
            header("Refresh: 2");
        }
        if(isset($_POST["alta"]))
        {
            $cesta = devolverCesta();
            if($cesta = null)
                trigger_error("La Cesta Esta Vacia");
            else
            {
                require_once ("../db/db.php");
                require_once ("../models/model_altEmpMas.php");
                altaEmpleados();
                vaciarCesta();
                print "<h2>Empleado Dado de Alta</h2>";
                header("Refresh: 2");
            }
        }
    }
    require_once ("../db/db.php");
    require_once ("../models/model_altEmpMas.php");
    $departamentos = saberDepartamentos();
    $cargos = saberCargos();
    require_once ("../views/view_altEmpMas.php");
?>