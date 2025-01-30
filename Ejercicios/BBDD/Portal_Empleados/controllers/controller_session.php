<?php

    function iniciarSession()
    {
        session_start();
    }

    function crearSession($idCli,$dept)
    {
        if(!isset($_SESSION["empleado"][$idCli]) && !isset($_SESSION["empleado"][$dept]))
        {
            $_SESSION["empleado"]["id"] = $idCli;
            $_SESSION["empleado"]["dept"] = $dept;
        }
    }

    function devolverId()
    {
        $id = $_SESSION["empleado"]["id"];
        return $id;
    }

    function devolverDept()
    {
        $dept = $_SESSION["empleado"]["dept"];
        return $dept;
    }

    function verificarSessionExistente()
    {
        $sessionCreada = false;
        if(isset($_SESSION["empleado"]))
            $sessionCreada = true;
        return $sessionCreada;
    }

    function annadirEmpleadosALaCesta(&$array)
    {
        if(isset($_SESSION["empleado"]["cesta"]))
        {
            $cesta = $_SESSION["empleado"]["cesta"];
            $cesta[] = $array;
        }   
        else
        {
            $cesta = array();
            $cesta[] = $array;
        }
        $_SESSION["empleado"]["cesta"] = $cesta;
    }

    function vaciarCesta()
    {
        unset($_SESSION["empleado"]["cesta"]);
    }

    function devolverCesta()
    {
        $cesta = null;
        if(isset($_SESSION["empleado"]["cesta"]))
            $cesta = $_SESSION["empleado"]["cesta"];
        return $cesta;
    }

    function eliminarVariablesSession()
    {
        session_destroy();
    }

    function eliminarSessionSinRedireccion()
    {
        session_destroy();
        session_unset();
        setcookie("PHPSESSID", "" , time() - (86400 * 30), "/",$_SERVER['HTTP_HOST']);
    }

?>