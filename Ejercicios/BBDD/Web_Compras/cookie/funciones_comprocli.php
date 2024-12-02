<?php
    include_once "../funciones_comunes.php";
    include_once "funcion_cookie.php";

    function recogerDatos()
    {
        $producto = limpiar($_POST['productos']);
        $unidades = intval(limpiar($_POST['unidades']));
        if($unidades < 1)
            trigger_error("Las unidades para comprar deben ser mayor a 0",E_USER_WARNING);
        return [$producto,$unidades];
    }

    function imprimirProductos()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT ID_PRODUCTO,NOMBRE FROM producto");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach ($resultado as $row)
            {
                print "<option value=".$row["ID_PRODUCTO"].">".$row["NOMBRE"]."</option>";
            }
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function annadirCestaCompra($producto,$unidad)
    {
        $nombreProducto = obtenerNombreProducto($producto);
        cookieCestaCompra($producto,$unidad,$nombreProducto);
    }

    function obtenerNombreProducto($id)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT NOMBRE FROM producto where ID_PRODUCTO = :id");
            $stmt->bindParam(':id', $id);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            $nombre = $resultado[0]["NOMBRE"];
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $nombre;
    }

    function imprimirCestaCompra()
    {
        if(isset($_COOKIE["cestaCompra"]))
        {
            $carritoCompra = unserialize($_COOKIE["cestaCompra"]);
            if($carritoCompra != null)
            {
                print "<div id='carrito'><h2>Carrito de la compra</h2>";
                print "<table border='1'><tr><th>Producto</th><th>Unidades</th></tr>";
                foreach ($carritoCompra as $producto=> $contenido)
                {
                    print "<tr><td>".$contenido["nombre"]."</td><td>".$contenido["unidades"]."</td></tr>";
                }
                print "</table></div>";
            }
        }
    }

    function comprarProductos()
    {
        if(isset($_COOKIE["cestaCompra"]) && isset($_COOKIE["nifUsuario"]))
        {
            $carritoCompra = unserialize($_COOKIE["cestaCompra"]);
            if($carritoCompra != null)
            {
                $idProductos = array();
                foreach ($carritoCompra as $producto => $contenido) {
                    $idProductos[] = comprarProducto($producto,$contenido["unidades"]);
                }
                eliminarProductoCestaCompra($idProductos);
            }
            else
            {
                print "<h2>No se ha podido comprar porque no hay productos en la cesta</h2>";
            }
        }
        elseif(!isset($_COOKIE["cestaCompra"]))
        {
            print "<h2>No se ha podido comprar porque no hay productos en la cesta</h2>";
        }
    }

    function comprarProducto($idProducto,$unidades)
    {
        $cliente = $_COOKIE["nifUsuario"];
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT a.NUM_ALMACEN as almacen,LOCALIDAD, p.NOMBRE as NOMRBE,CANTIDAD from almacena a,almacen al,producto p where a.NUM_ALMACEN = al.NUM_ALMACEN AND a.ID_PRODUCTO = :idProducto AND  a.NUM_ALMACEN = al.NUM_ALMACEN AND CANTIDAD >= :cantidad ORDER BY CANTIDAD");
            $stmt->bindParam(':idProducto', $idProducto);
            $stmt->bindParam(':cantidad', $unidades);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if($resultado == null)
            {
                trigger_error("No se realizar la compra por falta de existencias del producto");
                $idProducto = null;
            }
            else
            {
                $numAlamcen = $resultado[0]["almacen"];
                $stmt = $conn->prepare("SELECT NIF,ID_PRODUCTO,max(FECHA_COMPRA) as FECHA_COMPRA from compra where ID_PRODUCTO = :idProducto AND NIF=:nif");
                $stmt->bindParam(':idProducto', $idProducto);
                $stmt->bindParam(':nif', $cliente);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $resultado2=$stmt->fetchAll();
                if($resultado2[0]["FECHA_COMPRA"] != date("Y-m-d"))
                {
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $conn->beginTransaction();
                    $stmt = $conn->prepare("INSERT INTO compra (NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES) VALUES (:nif,:idProducto,curdate(),:unidades)");
                    $stmt->bindParam(':nif', $cliente);
                    $stmt->bindParam(':idProducto', $idProducto);
                    $stmt->bindParam(':unidades', $unidades);
                    $stmt->execute();
                    $stmt = $conn->prepare("UPDATE almacena set cantidad=cantidad-:unidades where NUM_ALMACEN=:idAlmacen AND ID_PRODUCTO=:idProducto");
                    $stmt->bindParam(':idAlmacen', $numAlamcen);
                    $stmt->bindParam(':idProducto', $idProducto);
                    $stmt->bindParam(':unidades', $unidades);
                    $stmt->execute();
                    $conn -> commit();

                    print "<h2>Compra Realizada</h2>";
                }
                else
                {
					if($resultado2[0]["FECHA_COMPRA"] = date("Y-m-d"))
                    {
                        $fechaHoy = date("Y-m-d");
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $conn->beginTransaction();
                        $stmt = $conn->prepare("UPDATE compra set UNIDADES = UNIDADES + :unidades WHERE NIF = :nif AND ID_PRODUCTO = :idProducto AND FECHA_COMPRA = curdate()");
                        $stmt->bindParam(':nif', $cliente);
                        $stmt->bindParam(':idProducto', $idProducto);
                        $stmt->bindParam(':unidades', $unidades);
                        $stmt->execute();
                        $stmt = $conn->prepare("UPDATE almacena set cantidad=cantidad-:unidades where NUM_ALMACEN=:idAlmacen AND ID_PRODUCTO=:idProducto");
                        $stmt->bindParam(':idAlmacen', $numAlamcen);
                        $stmt->bindParam(':idProducto', $idProducto);
                        $stmt->bindParam(':unidades', $unidades);
                        $stmt->execute();
                        $conn -> commit();
                        print "<h2>Compra Realizada</h2>";
                    }
                    else
                    {
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $conn->beginTransaction();
                        $stmt = $conn->prepare("INSERT INTO compra (NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES) VALUES (:nif,:idProducto,curdate(),:unidades)");
                        $stmt->bindParam(':nif', $cliente);
                        $stmt->bindParam(':idProducto', $idProducto);
                        $stmt->bindParam(':unidades', $unidades);
                        $stmt->execute();
                        $stmt = $conn->prepare("UPDATE almacena set cantidad=cantidad-:unidades where NUM_ALMACEN=:idAlmacen AND ID_PRODUCTO=:idProducto");
                        $stmt->bindParam(':idAlmacen', $numAlamcen);
                        $stmt->bindParam(':idProducto', $idProducto);
                        $stmt->bindParam(':unidades', $unidades);
                        $stmt->execute();
                        $conn -> commit();

                        print "<h2>Compra Realizada</h2>";
                    }
                }
            }
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $idProducto;
    }
?>