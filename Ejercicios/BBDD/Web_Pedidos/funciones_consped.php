<?php

    include_once "funciones_comunes.php";

    function imprimirClientes()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT customerNumber,customerName from customers LIMIT 20");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach ($resultado as $row)
                print "<option value=".$row["customerNumber"].">".$row["customerNumber"]."|".$row["customerName"]."</option>";
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
        $cliente = $_POST["clientes"];
        return $cliente;
    }

    function mostrarInformacionCliente($cliente)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT orderNumber,orderDate,status from orders where customerNumber = :cliente");
            $stmt->bindParam(':cliente', $cliente);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            print "<table border='1'><tr><th>Numero Pedido</th><th>Fecha Pedido</th><th>Estado Pedido</th><th>Numero Linea</th><th>Nombre Producto</th><th>Cantidad Pedida</th><th>Precio Unidad</th></tr>";
            foreach ($resultado as $row) {
                $stmt = $conn->prepare("SELECT orderLineNumber,quantityOrdered,priceEach,productName from orderdetails o,products p where o.orderNumber = :order and p.productCode = o.productCode");
                $stmt->bindParam(':order', $row["orderNumber"]);
                $stmt -> execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $resultado2=$stmt->fetchAll();
                foreach ($resultado2 as $row2)
                {
                    print "<tr><td>".$row["orderNumber"]."</td><td>".$row["orderDate"]."</td><td>".$row["status"]."</td><td>".$row2["orderLineNumber"]."</td><td>".$row2["productName"]."</td><td>".$row2["quantityOrdered"]."</td><td>".$row2["priceEach"]."</td></tr>";
                }
            }
            print "</table>";
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
?>