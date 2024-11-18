<?php
    include_once "funciones_comunes.php";

    function recogerDatos()
    {
        $cliente = limpiar($_POST['clientes']);
        $producto = limpiar($_POST['productos']);
        return [$cliente,$producto];
    }

    function imprimirClientes()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT NIF FROM cliente");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach ($resultado as $row)
            {
                print "<option value=".$row["NIF"].">".$row["NIF"]."</option>";
            }
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
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

    function comprarProducto($cliente,$producto)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT a.NUM_ALMACEN as almacen,LOCALIDAD, p.NOMBRE as NOMRBE,CANTIDAD from almacena a,almacen al,producto p where a.NUM_ALMACEN = al.NUM_ALMACEN AND a.ID_PRODUCTO = :idProducto AND  a.NUM_ALMACEN = al.NUM_ALMACEN ORDER BY CANTIDAD");
            $stmt->bindParam(':idProducto', $producto);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if($resultado == null)
            {
                trigger_error("No se realizar la compra por falta de existencias del producto",E_USER_WARNING);
            }
            else
            {
                $numAlamcen = $resultado[0]["almacen"];
                $stmt = $conn->prepare("SELECT NIF,ID_PRODUCTO,FECHA_COMPRA from compra where ID_PRODUCTO = :idProducto AND NIF=:nif");
                $stmt->bindParam(':idProducto', $producto);
                $stmt->bindParam(':nif', $cliente);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $resultado2=$stmt->fetchAll();
                if($resultado2 == null)
                {
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $conn->beginTransaction();
                    $stmt = $conn->prepare("INSERT INTO compra (NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES) VALUES (:nif,:idProducto,curdate(),1)");
                    $stmt->bindParam(':nif', $cliente);
                    $stmt->bindParam(':idProducto', $producto);
                    $stmt->execute();
                    $stmt = $conn->prepare("UPDATE almacena set cantidad=cantidad-1 where NUM_ALMACEN=:idAlmacen AND ID_PRODUCTO=:idProducto");
                    $stmt->bindParam(':idAlmacen', $numAlamcen);
                    $stmt->bindParam(':idProducto', $producto);
                    $stmt->execute();
                    $conn -> commit();

                    print "<h2>Compra Realizada</h2>";
                }
                else
                {
					if($resultado[0]["FECHA_COMPRA"] = date("Y-m-d"))
                    {
                        $fechaHoy = date("Y-m-d");
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $conn->beginTransaction();
                        $stmt = $conn->prepare("UPDATE compra set UNIDADES = UNIDADES + 1 WHERE NIF = :nif AND ID_PRODUCTO = :idProducto AND FECHA_COMPRA = :fechaHoy");
                        $stmt->bindParam(':nif', $cliente);
                        $stmt->bindParam(':idProducto', $producto);
                        $stmt->bindParam(':fechaHoy', $fechaHoy);
                        $stmt->execute();
                        $stmt = $conn->prepare("UPDATE almacena set cantidad=cantidad-1 where NUM_ALMACEN=:idAlmacen AND ID_PRODUCTO=:idProducto");
                        $stmt->bindParam(':idAlmacen', $numAlamcen);
                        $stmt->bindParam(':idProducto', $producto);
                        $stmt->execute();
                        $conn -> commit();
                        print "<h2>Compra Realizada</h2>";
                    }
                    else
                    {
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $conn->beginTransaction();
                        $stmt = $conn->prepare("INSERT INTO compra (NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES) VALUES (:nif,:idProducto,curdate(),1)");
                        $stmt->bindParam(':nif', $cliente);
                        $stmt->bindParam(':idProducto', $producto);
                        $stmt->execute();
                        $stmt = $conn->prepare("UPDATE almacena set cantidad=cantidad-1 where NUM_ALMACEN=:idAlmacen AND ID_PRODUCTO=:idProducto");
                        $stmt->bindParam(':idAlmacen', $numAlamcen);
                        $stmt->bindParam(':idProducto', $producto);
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
    }
?>