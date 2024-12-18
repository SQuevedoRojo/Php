<?php

    function iniciarSession()
    {
        session_start();
    }

    function crearSession($nif)
    {
        $_SESSION["nif"] = $nif;
    }

    function sessionCestaCompra($producto,$unidad,$nombre)
    {
        $contenidoSession = null;
        if(isset($_SESSION["cestaCompra"]))
        {
            $contenidoSession = ($_SESSION["cestaCompra"]);
            $productoIncrementado = false;
            foreach ($contenidoSession as $Idproducto => &$contenido)
            {
                if($Idproducto == $producto)
                {
                    $contenido["unidades"] += $unidad;
                    $productoIncrementado = true;
                }
            }
            if(!$productoIncrementado)
            {
                $contenidoSession[$producto]["unidades"] = $unidad;
                $contenidoSession[$producto]["nombre"] = $nombre;
            }
        }
        else
        {
            $contenidoSession = array();
            $contenidoSession[$producto]["unidades"] = $unidad;
            $contenidoSession[$producto]["nombre"] = $nombre;
        }
        $_SESSION["cestaCompra"] = ($contenidoSession);
    }

    function eliminarProductoCestaCompra($idProducto)
    {
        $cestaCompra =  ($_SESSION["cestaCompra"]);
        foreach ($cestaCompra as $producto => $unidades) {
            if($producto == $idProducto)
               unset($cestaCompra[$producto]);
        }
        if(count($cestaCompra) == 0)
            $cestaCompra = null;
        $_SESSION["cestaCompra"] = ($cestaCompra);
    }

    function eliminarCestaCompra()
    {
        if(isset($_SESSION["cestaCompra"]))
            unset($_SESSION["cestaCompra"]);
    }

    function verificarSessionExistente()
    {
        $sessionCreada = false;
        if((isset($_SESSION["nif"])))
            $sessionCreada = true;
        return $sessionCreada;
    }

    function eliminarSession()
    {
        session_destroy();
        session_unset();
        setcookie("PHPSESSID", "" , time() - (86400 * 30), "/",$_SERVER['HTTP_HOST']);
        header("Location: ./comlogincli.php");
    }
?>