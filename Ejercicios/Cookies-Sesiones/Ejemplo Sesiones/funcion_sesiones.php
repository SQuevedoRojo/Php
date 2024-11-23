<?php
    
    function iniciarSession($usuario,$contrasena)
    {
        session_start();
        $_SESSION["usuario"] = $usuario;
        $_SESSION["contrasena"] = $contrasena;
    }

    function eliminarSession()
    {
        session_destroy();
        session_unset();
    }

    function verificarSessionActiva()
    {
        $sessionCreada = false;
        if((isset($_SESSION["usuario"]) && isset($_SESSION["contrasena"])))
            $sessionCreada = true;
        return $sessionCreada;
    }
?>