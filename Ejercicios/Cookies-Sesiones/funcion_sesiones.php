<?php
    include_once "funcion_cookie.php";
    
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