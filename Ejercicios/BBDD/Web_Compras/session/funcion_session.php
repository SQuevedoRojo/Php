<?php

    function iniciarSession()
    {
        session_start();
    }

    function crearSession($nif)
    {
        $_SESSION["nif"] = $nif;
    }

    function sessionCestaCompra($producto,$unidad)
    {
        $contenidoSession = null;
        if(isset($_SESSION["cestaCompra"]))
        {
            $contenidoSession = unserialize($_SESSION["cestaCompra"]);
            $productoIncrementado = false;
            foreach ($contenidoSession as $Idproducto => &$unidades)
            {
                if($Idproducto == $producto)
                {
                    $unidades += $unidad;
                    $productoIncrementado = true;
                }
            }
            if(!$productoIncrementado)
                $contenidoSession[$producto] = $unidad;

        }
        else
        {
            $contenidoSession = array();
            $contenidoSession[$producto] = $unidad;
        }
        $_SESSION["cestaCompra"] = serialize($contenidoSession);
    }

    function eliminarProductoCestaCompra($idProducto)
    {
        $cestaCompra =  unserialize($_SESSION["cestaCompra"]);
        foreach ($cestaCompra as $producto => $unidades) {
            if($producto == $idProducto)
               unset($cestaCompra[$producto]);
        }
        if(count($cestaCompra) == 0)
            $cestaCompra = null;
        $_SESSION["cestaCompra"] = serialize($cestaCompra);
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