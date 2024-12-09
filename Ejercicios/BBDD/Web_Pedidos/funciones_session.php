<?php

    function iniciarSession()
    {
        session_start();
    }

    function crearSession($idCli)
    {
        if(isset($_SESSION["cliente"]) && $_SESSION["cliente"] != null)
            $_SESSION["cliente"]["numeroCliente"] = $idCli;
    }

    function verificarSessionExistente()
    {
        $sessionCreada = false;
        if(isset($_SESSION["cliente"]))
            $sessionCreada = true;
        return $sessionCreada;
    }

    function intentosInicioSesion($idCli)
    {
        if(isset($_SESSION["cliente"]) && $_SESSION["cliente"]["numeroCliente"] == $idCli)
        {
            if(isset($_SESSION["cliente"]["intentosSesion"]))
                $_SESSION["cliente"]["intentosSesion"] += 1;
            else
                $_SESSION["cliente"]["intentosSesion"] = 1;
        }
    }

    function saberIntentosSesion($idCli)
    {
        $intentos = null;
        if(isset($_SESSION["cliente"]) && $_SESSION["cliente"]["numeroCliente"] == $idCli)
        {
            if(isset($_SESSION["cliente"]["intentosSesion"]))
                $intentos = $_SESSION["cliente"]["intentosSesion"];
            else
                $intentos = 0;
        }
        if($intentos == 3)
            $_SESSION["cliente"] = null;
        return $intentos;
    }

    function eliminarSession()
    {
        session_destroy();
        session_unset();
        setcookie("PHPSESSID", "" , time() - (86400 * 30), "/",$_SERVER['HTTP_HOST']);
        header("Location: ./pe_login.php");
    }
?>