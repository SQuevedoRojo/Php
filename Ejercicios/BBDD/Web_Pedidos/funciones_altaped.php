<?php
    include_once "funciones_comunes.php";
    include_once "funciones_session.php";

    function imprimirPedido()
    {
        if(isset($_SESSION["cliente"]["pedido"]))
        {
            $pedido = $_SESSION["cliente"]["pedido"];
            print "<div id='pedido'><h2>Pedido</h2>";
            print "<table border='1'><tr><th>Numero Producto</th><th>Nombre Producto</th><th>Cantidad Producto</th></tr>";
            foreach ($pedido as $idProd => &$contenido) {
                print "<tr><td>$idProd</td><td>".$contenido["nombre"]."</td><td>".$contenido["cantidad"]."</td></tr>";
            }
            print "</table></div>";
        }
    }

    function imprimirProductos()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT productCode,productName from products where quantityInStock >=0 LIMIT 20");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach ($resultado as $row)
                print "<option value=".$row["productCode"].">".$row["productName"]."</option>";
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function recogerDatos()
    {
        $producto = limpiar($_POST["productos"]);
        $cantidad = limpiar($_POST["cantidad"]);
        return [$producto,$cantidad];
    }

    function obtenerNombreProducto($producto)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT productName from products where productCode = :producto");
            $stmt->bindParam(':producto', $producto);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            $nombre = $resultado[0]["productName"];
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        return $nombre;
        $conn = null;
    }

    function annadirAlPedido($producto,$cantidad)
    {
        $nombre = obtenerNombreProducto($producto);
        annadirPedido($producto,$cantidad,$nombre);
    }

    function obtenerNumeroPedido()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT max(orderNumber) as orderNumber from orders");
            $stmt->bindParam(':producto', $producto);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            $numeroPedido = intval($resultado[0]["orderNumber"]) + 1;
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        return $numeroPedido;
        $conn = null;
    }

    function realizarPedido()
    {
        if(isset($_SESSION["cliente"]["pedido"]))
        {
            $numeroPedido = obtenerNumeroPedido();

            $conn = conexionBBDD();
            try
            {
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->beginTransaction();
                $stmt = $conn->prepare("INSERT INTO orders (orderNumber,orderDate,requiredDate,shippedDate,status,comments,customerNumber) values (:numeroPedido,curdate(),curdate(),null,null,null,:numeroCliente)");
                $stmt->bindParam(':numeroPedido', $numeroPedido);
                $stmt->bindParam(':numeroCliente', $_SESSION["cliente"]["id"]);
                $stmt -> execute();
                $conn -> commit();
            }
            catch(PDOException $e)
            {
                $conn -> rollBack();
                echo "Error: " . $e->getMessage();
            }
            $conn = null;

            $pedido = $_SESSION["cliente"]["pedido"];
            foreach ($pedido as $idProd => &$contenido) {
                realizarPedidoPorProducto($idProd,$contenido["cantidad"],$numeroPedido);
            }
        }
        else
            trigger_error("No hay ningun producto en el pedido para procesar");
    }

    function realizarPedidoPorProducto($producto,$cantidad,$numeroPedido)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT MSRP from products where productCode = :prod and (quantityInStock - :cantidad) >= 0");
            $stmt->bindParam(':prod', $producto);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if($resultado != null)
            {
                $precio = $resultado[0]["MSRP"];
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->beginTransaction();
                $stmt = $conn->prepare("UPDATE products set quantityInStock = quantityInStock - :cantidad where productCode = :producto");
                $stmt->bindParam(':producto', $producto);
                $stmt->bindParam(':cantidad', $cantidad);
                $stmt -> execute();
                $conn -> commit();
                /*****************************************************************************************************************************/
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->beginTransaction();
                $stmt = $conn->prepare("INSERT INTO orderdetails (orderNumber,productCode,quantityOrdered,priceEach,orderLineNumber) values (:numeroPedido,:producto,:cantidad,:precio,null)");
                $stmt->bindParam(':numeroPedido', $numeroPedido);
                $stmt->bindParam(':producto', $producto);
                $stmt->bindParam(':cantidad', $cantidad);
                $stmt->bindParam(':precio', $precio);
                $stmt -> execute();
                $conn -> commit();

                quitarProductoDelPedido($producto);
                print "<h2>$producto Procesado Perfectamente</h2>";
            }
            else
            {
                trigger_error("No Se Puede Procesar El Producto $producto Porque No Hay Suficiente Stock");
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