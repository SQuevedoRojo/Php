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

    function verificarCookieExistente()
    {
        $cookiesCreadas = false;
        if((isset($_COOKIE["nombreUsuario"]) && isset($_COOKIE["nombreContrasena"])))
            $cookiesCreadas = true;
        return $cookiesCreadas;
    }

?>