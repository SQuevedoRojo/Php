<?php

    function iniciarSession()
    {
        session_start();
    }

    function crearSession($idCli)
    {
        if(!isset($_SESSION["cliente"][$idCli]))
            $_SESSION["cliente"][$idCli] = array();
    }

    function verificarSessionExistente()
    {
        $sessionCreada = false;
        if(isset($_SESSION["cliente"]["id"]) && isset($_SESSION["cliente"]["inicioCorrecto"]))
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
        if(isset($_SESSION["cliente"]) && isset($_SESSION["cliente"][$idCli]))
        {
            if(isset($_SESSION["cliente"][$idCli]["intentosSesion"]))
                $intentos = $_SESSION["cliente"][$idCli]["intentosSesion"];
            else
                $intentos = 0;
        }
        if($intentos == 2)
            unset($_SESSION["cliente"][$idCli]);
        return $intentos;
    }

    function inicioCorrecto($idCli)
    {
        if(isset($_SESSION["cliente"]) && isset($_SESSION["cliente"][$idCli]))
        {
            session_unset();
            $_SESSION["cliente"]["id"] = $idCli;
            $_SESSION["cliente"]["inicioCorrecto"] = true;
        }
    }

    function annadirPedido($producto,$cantidad,$nombre)
    {
        $pedido = null;
        if(isset($_SESSION["cliente"]["pedido"]))
        {
            $pedido = $_SESSION["cliente"]["pedido"];
            $productoIncrementado = false;
            foreach ($pedido as $Idproducto => &$contenido)
            {
                if($Idproducto == $producto)
                {
                    $contenido["cantidad"] += $cantidad;
                    $productoIncrementado = true;
                }
            }
            if(!$productoIncrementado)
            {
                $pedido[$producto]["cantidad"] = $cantidad;
                $pedido[$producto]["nombre"] = $nombre;
            }
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
                unset($pedido[$idProd]);
        }
        $_SESSION["cliente"]["pedido"] = $pedido;
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