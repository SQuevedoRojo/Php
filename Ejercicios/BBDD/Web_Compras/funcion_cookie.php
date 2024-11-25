<?php

    function crearCookie($nif)
    {
        setcookie("nifUsuario", $nif, time() + (86400 * 30), "/");
    }

    function eliminarCookie()
    {
        setcookie("nifUsuario", "" , time() - (86400 * 30), "/");
        setcookie("cestaCompra", "" , time() - (86400 * 30), "/");
        header("Location: ./comlogincli.php");
    }

    function annadirCestaCompra($producto,$unidad)
    {
        $contenidoCookie = null;
        if(isset($_COOKIE["cestaCompra"]))
        {
            $contenidoCookie = $_COOKIE["cestaCompra"] . $producto .";". strval($unidad) . "|";
        }
        else
        {
            $contenidoCookie = $producto .";". strval($unidad) . "|";
        }
        setcookie("cestaCompra", $contenidoCookie , time() + (86400 * 30), "/");
    }

    function verificarCookieExistente()
    {
        $cookiesCreadas = false;
        if((isset($_COOKIE["nifUsuario"])))
            $cookiesCreadas = true;
        return $cookiesCreadas;
    }

?>