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
        if(isset($_COOKIE["cestaCompra"]) && unserialize($_COOKIE["cestaCompra"]) != null)
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

    function eliminarProductoCestaCompra($idProductos)
    {
        $cestaCompra =  unserialize($_COOKIE["cestaCompra"]);
        $indice = 0;
        foreach ($cestaCompra as $producto => $unidades) {
            if($producto == $idProductos[$indice])
               unset($cestaCompra[$producto]);
            $indice += 1; 
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