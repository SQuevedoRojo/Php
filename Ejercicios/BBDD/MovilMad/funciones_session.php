<?php

    function iniciarSession()
    {
        session_start();
    }

    function crearSession($idCli,$nombreCompleto)
    {
        if(!isset($_SESSION["cliente"][$idCli]) && !isset($_SESSION["cliente"][$nombreCompleto]))
        {
            $_SESSION["cliente"]["id"] = $idCli;
            $_SESSION["cliente"]["nombre"] = $nombreCompleto;
        }
    }

    function devolverId()
    {
        return $_SESSION["cliente"]["id"];
    }

    function devolverNombre()
    {
        return $_SESSION["cliente"]["nombre"];
    }


    function verificarSessionExistente()
    {
        $sessionCreada = false;
        if(isset($_SESSION["cliente"]))
            $sessionCreada = true;
        return $sessionCreada;
    }

    function eliminarVariablesSession()
    {
        session_destroy();
    }

    function eliminarSession()
    {
        session_destroy();
        session_unset();
        setcookie("PHPSESSID", "" , time() - (86400 * 30), "/",$_SERVER['HTTP_HOST']);
        header("Location: ./movlogin.php");
    }

    function eliminarSessionSinRedireccion()
    {
        session_destroy();
        session_unset();
        setcookie("PHPSESSID", "" , time() - (86400 * 30), "/",$_SERVER['HTTP_HOST']);
    }
?>