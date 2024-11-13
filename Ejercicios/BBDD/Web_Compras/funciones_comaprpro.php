<?php
    include_once "funciones_comunes.php";

    function recogerDatos()
    {
        $cantidadProductos = limpiar($_POST['localidad']);
        $producto = $_POST['productos'];
        $almacen = $_POST['almacenes'] ;
        if($cantidadProductos < 0)
            trigger_error("No se pueden insertar en los almacenes 0 productos o menos",E_USER_WARNING);
        return [$cantidadProductos,$producto,$almacen];
    }

    function imprimirAlmacenes()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT NUM_ALMACEN,LOCALIDAD FROM almacen");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach ($resultado as $row)
            {
                print "<option value=".$row["NUM_ALMACEN"].">".$row["LOCALIDAD"]."</option>";
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

    function insertarProductosEnAlmacen($cantidadProductos,$producto,$almacen)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT CANTIDAD FROM almacena where ID_PRODUCTO=:idProducto AND NUM_ALMACEN=:idAlmacen");
            $stmt->bindParam(':idProducto', $producto);
            $stmt->bindParam(':idAlmacen', $almacen);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if($resultado[0]["CANTIDAD"] == null)
            {
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->beginTransaction();
                $stmt = $conn->prepare("INSERT INTO almacena (ID_PRODUCTO,NUM_ALMACEN,CANTIDAD) VALUES (:idProducto,:idAlmacen,:cantidad)");
                $stmt->bindParam(':idProducto', $producto);
                $stmt->bindParam(':idAlmacen', $almacen);
                $stmt->bindParam(':cantidad', $cantidadProductos);
                $stmt->execute();
                $conn -> commit();
                print "<h2>Cantidad de Productos insertado exitosamente</h2>";
            }
            else
            {
                $cantidadProductosExistentes = $resultado[0]["CANTIDAD"];
                $cantidadProductos += $cantidadProductosExistentes;
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->beginTransaction();
                $stmt = $conn->prepare("UPDATE almacena set CANTIDAD=:cantidad where ID_PRODUCTO=:idProducto AND NUM_ALMACEN=:idAlmacen");
                $stmt->bindParam(':idProducto', $producto);
                $stmt->bindParam(':idAlmacen', $almacen);
                $stmt->bindParam(':cantidad', $cantidadProductos);
                $stmt->execute();
                $conn -> commit();
                print "<h2>Cantidad de Productos insertado exitosamente</h2>";
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