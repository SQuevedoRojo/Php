<?php

    include_once "funciones_comunes.php";

    function imprimirTipoProductos()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT productLine from productlines");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach ($resultado as $row)
                print "<option value=\"".$row["productLine"]."\"\>".$row["productLine"]."</option>";
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function recogerDatos()
    {
        $tipoProducto = limpiar($_POST["tipoProductos"]);
        return $tipoProducto;
    }

    function mostrarInformacionTipoProducto($tipoProducto)
    {
        
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT productCode,productName,quantityInStock from products where productLine = :tipoProducto order by 3 desc");
            $stmt->bindParam(':tipoProducto', $tipoProducto);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            print "<table border='1'><tr><th>Numero Producto</th><th>Nombre Producto</th><th>Stock Producto</th></tr>";
            foreach ($resultado as $row) {
                print "<tr><td>".$row["productCode"]."</td><td>".$row["productName"]."</td><td>".$row["quantityInStock"]."</td></tr>";
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