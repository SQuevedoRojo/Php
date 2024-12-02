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

    function cookieCestaCompra($producto,$unidad,$nombre)
    {
        $contenidoCookie = null;
        if(isset($_COOKIE["cestaCompra"]) && unserialize($_COOKIE["cestaCompra"]) != null)
        {
            $contenidoCookie = unserialize($_COOKIE["cestaCompra"]);
            $productoIncrementado = false;
            foreach ($contenidoCookie as $Idproducto => &$contenido)
            {
                if($Idproducto == $producto)
                {
                    $contenido["unidades"] += $unidad;
                    $productoIncrementado = true;
                }
            }
            if(!$productoIncrementado)
            {
                $contenidoCookie[$producto]["unidades"] = $unidad;
                $contenidoCookie[$producto]["nombre"] = $nombre;
            }

        }
        else
        {
            $contenidoCookie = array();
            $contenidoCookie[$producto]["nombre"] = $nombre;
            $contenidoCookie[$producto]["unidades"] = $unidad;
        }
        setcookie("cestaCompra", serialize($contenidoCookie) , time() + (86400 * 30), "/");
    }

    function eliminarProductoCestaCompra($idProductos)
    {
        $cestaCompra =  unserialize($_COOKIE["cestaCompra"]);
        foreach ($cestaCompra as $producto => $contenido) {
            for ($i=0; $i < count($idProductos); $i++) { 
                if($idProductos[$i] != null  && $producto == $idProductos[$i])
                    unset($cestaCompra[$producto]);
            }
        }
        if(count($cestaCompra) == 0)
            $cestaCompra = null;
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