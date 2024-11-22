<?php
    include "funcion_cookie.php";
    include_once "funcion_sesiones.php";
    
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
        eliminarCookieSession("PHPSESSID");
    }
?>