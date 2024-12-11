<?php

    function iniciarSession()
    {
        session_start();
    }

    function crearSession($idCli)
    {
        if(!(isset($_SESSION["cliente"]) && $_SESSION["cliente"] != null))
            $_SESSION["cliente"][$idCli] = array();
    }

    function verificarSessionExistente($idCli)
    {
        $sessionCreada = false;
        if(isset($_SESSION["cliente"][$idCli]["sesionIniciada"]))
            $sessionCreada = true;
        return $sessionCreada;
    }

    function intentosInicioSesion($idCli)
    {
        if(isset($_SESSION["cliente"]) && isset($_SESSION["cliente"][$idCli]))
        {
            if(isset($_SESSION["cliente"][$idCli]["intentosSesion"]))
                $_SESSION["cliente"][$idCli]["intentosSesion"] += 1;
            else
                $_SESSION["cliente"][$idCli]["intentosSesion"] = 1;
        }
    }

    function saberIntentosSesion($idCli)
    {
        $intentos = null;
        if(isset($_SESSION["cliente"]) && $_SESSION["cliente"][$idCli]["numeroCliente"])
        {
            if(isset($_SESSION["cliente"][$idCli]["intentosSesion"]))
                $intentos = $_SESSION["cliente"][$idCli]["intentosSesion"];
            else
                $intentos = 0;
        }
        if($intentos == 2)
            eliminarSessionBloqueo();
        return $intentos;
    }

    function inicioCorrecto($idCli)
    {
        if(isset($_SESSION["cliente"]) && isset($_SESSION["cliente"][$idCli]))
            $_SESSION["cliente"][$idCli]["sesionIniciada"] = true;
    }

    function annadirPedido($producto,$cantidad,$nombre)
    {
        $pedido = null;
        if(isset($_SESSION["cliente"]["pedido"]))
        {
            $pedido = $_SESSION["cliente"]["pedido"];
            $pedido[$producto]["cantidad"] += $cantidad;
            $pedido[$producto]["nombre"] = $nombre;
        }
        else
        {
            $pedido = array();
            $pedido[$producto]["cantidad"] = $cantidad;
            $pedido[$producto]["nombre"] = $nombre;
        }
        $_SESSION["cliente"]["pedido"] = $pedido;
    }

    function quitarProductoDelPedido($prod)
    {
        $pedido = $_SESSION["cliente"]["pedido"];
        foreach ($pedido as $idProd => &$contenido) {
            if($idProd == $prod)
                unset($pedido[$prod]);
        }
    }

    function eliminarVariablesSession()
    {
        session_destroy();
    }

    function eliminarSessionBloqueo()
    {
        session_destroy();
        session_unset();
        setcookie("PHPSESSID", "" , time() - (86400 * 30), "/",$_SERVER['HTTP_HOST']);
    }

    function eliminarSession()
    {
        session_destroy();
        session_unset();
        setcookie("PHPSESSID", "" , time() - (86400 * 30), "/",$_SERVER['HTTP_HOST']);
        header("Location: ./pe_login.php");
    }
?>