<?php

    function iniciarSession()
    {
        session_start();
    }

    function crearSession(&$idCli,&$nombreCompleto)
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

    function annadirALaCesta($matricula)
    {
        if(isset($_SESSION["cliente"]["cesta"]))
        {
            $vehiculos = $_SESSION["cliente"]["cesta"];
            if(count($vehiculos) == 3)
            {
                trigger_error("Solo Se Pueden Alquilar 3 Vehiculos");
            }
            else
            {
                if(in_array($matricula,$vehiculos))
                {
                    trigger_error("No se Puede Alquilar el Mismo Vehiculo Dos Veces");
                }
                else
                {
                    $vehiculos[] = $matricula;
                }
            }
        }
        else
        {
            $vehiculos = array();
            $vehiculos[] = $matricula;
        }
        $_SESSION["cliente"]["cesta"] = $vehiculos;
    }

    function imprimirCesta()
    {
        if(isset($_SESSION["cliente"]["cesta"]))
        {
            $vehiculos = $_SESSION["cliente"]["cesta"];
            print "<table border='1'><tr><th>Matriculas de los Vehiculos</th></tr>";
            for ($i=0; $i < count($vehiculos); $i++) { 
                print "<tr><td>".$vehiculos[$i]."</td></tr>";
            }
            print "</table>";
        }
    }

    function annadirCuantosVehiculosAlquilados($cantidad)
    {
        if(isset($_SESSION["cliente"]["alquilados"]))
        {
            $alquilados = $_SESSION["cliente"]["alquilados"] +$cantidad; 
        }
        else
        {
            $alquilados = $cantidad;
        }
        $_SESSION["cliente"]["alquilados"] = $alquilados;
    }

    function saberVehiculosAlquilados()
    {
        if(isset($_SESSION["cliente"]["alquilados"]))
            return $_SESSION["cliente"]["alquilados"];
        else
            return 0;
    }

    function vaciarVehiculoEspecifico($matricula)
    {
        if(isset($_SESSION["cliente"]["cesta"]))
            unset($_SESSION["cliente"]["cesta"][$matricula]);
    }

    function vaciarCesta()
    {
        if(isset($_SESSION["cliente"]["cesta"]))
            unset($_SESSION["cliente"]["cesta"]);
    }

    function devolverCesta()
    {
        if(isset($_SESSION["cliente"]["cesta"]))
            return $_SESSION["cliente"]["cesta"];
        else
            return null;
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