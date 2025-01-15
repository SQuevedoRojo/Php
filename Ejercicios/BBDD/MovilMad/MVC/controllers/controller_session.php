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
        $id = $_SESSION["cliente"]["id"];
        return $id;
    }

    function devolverNombre()
    {
        $nombre = $_SESSION["cliente"]["nombre"];
        return $nombre;
    }

    function verificarSessionExistente()
    {
        $sessionCreada = false;
        if(isset($_SESSION["cliente"]))
            $sessionCreada = true;
        return $sessionCreada;
    }

    function annadirVehiculosALaCesta($matricula)
    {
        if(isset($_SESSION["cliente"]["cesta"]))
        {
            $cesta = $_SESSION["cliente"]["cesta"];
            $vehiculosAlquilados = saberVehiculosAlquilados($_SESSION["cliente"]["id"]);
            if($vehiculosAlquilados < 3)
            {
                $cesta[] = $matricula;
            }
            else
            {
                trigger_error("Ya tienes alquilados 3 vehiculos. Devuelvelos para alquilar mas");
            }
        }   
        else
        {
            $cesta = array();
            $cesta[] = $matricula;
        }
        $_SESSION["cliente"]["cesta"] = $cesta;
    }

    function vaciarCesta()
    {
        unset($_SESSION["cliente"]["cesta"]);
    }

    function recuperarCesta()
    {
        $tablaCesta = null;
        if(isset($_SESSION["cliente"]["cesta"]))
        {
            $cesta = $_SESSION["cliente"]["cesta"];
            $tablaCesta = "<table border='1'><tr><th>Matriculas de los Vehiculos</th></tr>";
            for ($i=0; $i < count($cesta); $i++) { 
                $tablaCesta = $tablaCesta . "<tr><td>".$cesta[$i]."</td></tr>";
            }
            $tablaCesta = $tablaCesta . "</table>";
        }
        return $tablaCesta;
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