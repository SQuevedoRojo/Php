<?php

    function iniciarSession()
    {
        session_start();
    }

    function crearSession($idCli)
    {
        if(!isset($_SESSION["cliente"][$idCli]))
        {
            $_SESSION["cliente"]["id"] = $idCli;
            $_SESSION["cliente"]["indice"] = 0;
        }
    }

    function devolverId()
    {
        $id = $_SESSION["cliente"]["id"];
        return $id;
    }

    function devolverIndice()
    {
        $indice = $_SESSION["cliente"]["indice"];
        return $indice;
    }

    function aumentarIndice()
    {
        $indice = $_SESSION["cliente"]["indice"];
        if($indice <=3503)
            $_SESSION["cliente"]["indice"] = ($indice + 20);
    }

    function disminuirIndice()
    {
        $indice = $_SESSION["cliente"]["indice"];
        if($indice >= 20)
            $_SESSION["cliente"]["indice"] = ($indice - 20);
    }

    function verificarSessionExistente()
    {
        $sessionCreada = false;
        if(isset($_SESSION["cliente"]))
            $sessionCreada = true;
        return $sessionCreada;
    }

    function annadirCancionesALaCesta($cancion)
    {
        $detallesCancion = explode("|",$cancion);
        if(isset($_SESSION["cliente"]["cesta"]))
        {
            $cesta = $_SESSION["cliente"]["cesta"];
            $cesta[] = $detallesCancion;
        }   
        else
        {
            $cesta = array();
            $cesta[] = $detallesCancion;
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