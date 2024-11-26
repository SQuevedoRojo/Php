<?php

    function crearCookie($nif)
    {
        setcookie("nifUsuario", $nif, time() + (86400 * 30), "/");
    }

    function eliminarCookie()
    {
        setcookie("nifUsuario", "" , time() - (86400 * 30), "/");
        if(isset($_COOKIE["cestaCompra"]))
            setcookie("cestaCompra", "" , time() - (86400 * 30), "/");
        header("Location: ./comlogincli.php");
    }

    function cookieCestaCompra($producto,$unidad)
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

    function eliminarProductoCestaCompra($idProducto)
    {
        $cestaCompra = explode("|",$_COOKIE["cestaCompra"]);
        $indice = 0;
        $productoEncontrado = false;
        while($indice < count($cestaCompra) && !$productoEncontrado)
        {
            $producto = explode(";",$cestaCompra[$indice]);
            if($producto[0] == $idProducto)
                $productoEncontrado = true;
            else
                $indice += 1;
        }
        $restoCesta = "";
        for ($i=$indice; $i < count($cestaCompra); $i++) 
        { 
            $restoCesta = $restoCesta . $cestaCompra[$i];
        }
        setcookie("cestaCompra", $restoCesta , time() + (86400 * 30), "/");
    }

    function eliminarCestaCompra()
    {
        if(isset($_COOKIE["cestaCompra"]))
            setcookie("cestaCompra", "" , time() - (86400 * 30), "/");
    }

    function verificarCookieExistente()
    {
        $cookiesCreadas = false;
        if((isset($_COOKIE["nifUsuario"])))
            $cookiesCreadas = true;
        return $cookiesCreadas;
    }

?>