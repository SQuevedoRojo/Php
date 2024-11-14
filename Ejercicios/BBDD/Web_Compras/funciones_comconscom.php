<?php
    include_once "funciones_comunes.php";

    function recogerDatos()
    {
        $clientes = $_POST['clientes'];
        $fechaInicio = limpiar($_POST['clientes']);
        $fechaFinal = limpiar($_POST['clientes']);
        return [$clientes,$fechaInicio,$fechaFinal];
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

    function mostrarCompras($cliente,$fechaInicio,$fechaFinal)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT UNIDADES , p.NOMBRE as NOMRBE,PRECIO from compra c,producto p where c.NIF = :nif AND c.ID_PRODUCTO = p.ID_PRODUCTO AND FECHA_COMPRA >= :fec_ini AND FECHA_COMPRA <= :fec_final");
            $stmt->bindParam(':nif', $cliente);
            $stmt->bindParam(':fec_ini', $fechaInicio);
            $stmt->bindParam(':fec_final', $fechaFinal);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if($resultado != null)
            {
                $precioTotalCompras = null;
                print "<table border='1'>";
                print "<tr><th>CANTIDAD PRODUCTO</th><th>PRODUCTO</th><th>PRECIO</th></tr>";
                foreach ($resultado as $row) {
                    print "<tr><td>".$row["UNIDADES"]."</td><td>".$row["NOMBRE"]."</td><td>".$row["PRECIO"]."</td></tr>";
                    $precioTotalCompras += (intval($row["UNIDADES"]) * intval($row["PRECIO"]));
                }
                print "</table>";
                print "<br><h2>El precio total de todas las compras ha sido de $precioTotalCompras €</h2>";
            }
            else
                print "<h2>El cliente no ha hecho ninguna compra</h2>";

        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
?>