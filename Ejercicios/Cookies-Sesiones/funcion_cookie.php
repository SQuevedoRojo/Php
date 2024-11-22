<?php

    function crearCookie($usuario,$contrasena)
    {
        setcookie("nombreUsuario", $usuario, time() + (86400 * 30), "/");
        setcookie("nombreContrasena", $contrasena, time() + (86400 * 30), "/");
    }

    function eliminarCookie()
    {
        setcookie("nombreUsuario", "" , time() - (86400 * 30), "/");
        setcookie("nombreContrasena", "", time() - (86400 * 30), "/");
    }

    function eliminarCookieSession($nombreCookie)
    {
        setcookie($nombreCookie, "", time() - (86400 * 90), "/");
    }

?>