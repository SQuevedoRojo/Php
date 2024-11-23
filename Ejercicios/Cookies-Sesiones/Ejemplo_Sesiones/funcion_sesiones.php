<?php
    
    function iniciarSession()
    {
        session_start();
    }

    function asignarVariablesSession($usuario,$contrasena)
    {
        $_SESSION["usuario"] = $usuario;
        $_SESSION["contrasena"] = $contrasena;
    }

    function eliminarSession()
    {
        session_destroy();
        session_unset();
        setcookie("PHPSESSID", "" , time() - (86400 * 30), "/",$_SERVER['HTTP_HOST']);
        header("Location: ./login.php");
    }

    function verificarSessionActiva()
    {
        $sessionCreada = false;
        if((isset($_SESSION["usuario"]) && isset($_SESSION["contrasena"])))
            $sessionCreada = true;
        return $sessionCreada;
    }
?>