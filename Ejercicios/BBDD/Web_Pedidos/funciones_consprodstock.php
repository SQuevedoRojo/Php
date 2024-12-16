<?php

    include_once "funciones_comunes.php";

    function imprimirProductos()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT productCode,productName from products LIMIT 20");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach ($resultado as $row)
                print "<option value=".$row["productCode"].">".$row["productCode"]."|".$row["productName"]."</option>";
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
        $producto = $_POST["productos"];
        return $producto;
    }

    function mostrarInformacionProducto($producto)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT productName,quantityInStock from products where productCode = :producto");
            $stmt->bindParam(':producto', $producto);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            print "Stock del Producto ".$resultado[0]["productName"]." -> ".$resultado[0]["quantityInStock"]." Unidades";
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
?>