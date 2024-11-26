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
            $contenidoCookie = unserialize($_COOKIE["cestaCompra"]);
            $productoIncrementado = false;
            foreach ($contenidoCookie as $Idproducto => &$unidades)
            {
                if($Idproducto == $producto)
                {
                    $unidades += $unidad;
                    $productoIncrementado = true;
                }
            }
            if(!$productoIncrementado)
                $contenidoCookie[$producto] = $unidad;

        }
        else
        {
            $contenidoCookie = array();
            $contenidoCookie[$producto] = $unidad;
        }
        setcookie("cestaCompra", serialize($contenidoCookie) , time() + (86400 * 30), "/");
    }

    function eliminarProductoCestaCompra($idProducto)
    {
        $cestaCompra =  unserialize($_COOKIE["cestaCompra"]);
        foreach ($cestaCompra as $producto => $unidades) {
            if($producto == $idProducto)
               unset($cestaCompra[$producto]);
        }
        setcookie("cestaCompra", serialize($cestaCompra) , time() + (86400 * 30), "/");;
    }

    function eliminarCestaCompra()
    {
        if(isset($_COOKIE["cestaCompra"]))
            setcookie("cestaCompra", "" , time() - (86400 * 31), "/");
    }

    function verificarCookieExistente()
    {
        $cookiesCreadas = false;
        if((isset($_COOKIE["nifUsuario"])))
            $cookiesCreadas = true;
        return $cookiesCreadas;
    }

?>