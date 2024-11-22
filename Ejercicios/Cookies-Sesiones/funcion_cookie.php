<?php

    function crearCookie($usuario,$contraseña)
    {
        setcookie($usuario, $contraseña, time() + (86400 * 30), "/");
    }

    function eliminarCookie($usuario,)
    {
        setcookie($usuario, "" , time() - (86400 * 30), "/");
    }

?>