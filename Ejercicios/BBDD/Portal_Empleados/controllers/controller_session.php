<?php

    function iniciarSession()
    {
        session_start();
    }

    function crearSession($idCli,$dept)
    {
        if(!isset($_SESSION["cliente"][$idCli]) && !isset($_SESSION["cliente"][$dept]))
        {
            $_SESSION["cliente"]["id"] = $idCli;
            $_SESSION["cliente"]["dept"] = $dept;
        }
    }

    function devolverId()
    {
        $id = $_SESSION["cliente"]["id"];
        return $id;
    }

    function devolverDept()
    {
        $dept = $_SESSION["cliente"]["dept"];
        return $dept;
    }

    function verificarSessionExistente()
    {
        $sessionCreada = false;
        if(isset($_SESSION["cliente"]))
            $sessionCreada = true;
        return $sessionCreada;
    }

    function annadirEmpleadosALaCesta(&$array)
    {
        if(isset($_SESSION["cliente"]["cesta"]))
        {
            $cesta = $_SESSION["cliente"]["cesta"];
            $cesta[] = $array;
        }   
        else
        {
            $cesta = array();
            $cesta[] = $array;
        }
        $_SESSION["cliente"]["cesta"] = $cesta;
    }

    function vaciarCesta()
    {
        unset($_SESSION["cliente"]["cesta"]);
    }

    function devolverCesta()
    {
        $cesta = null;
        if(isset($_SESSION["cliente"]["cesta"]))
            $cesta = $_SESSION["cliente"]["cesta"];
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