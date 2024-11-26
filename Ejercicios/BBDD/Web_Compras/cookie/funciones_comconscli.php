<?php
    include_once "../funciones_comunes.php";

    function recogerDatos()
    {
        $clientes = $_COOKIE['nifUsuario'];
        $fechaInicio = limpiar($_POST['fec_inic']);
        $fechaFinal = limpiar($_POST['fec_fin']);
        if(!verificarFecha($fechaInicio) || !verificarFecha($fechaFinal))
            trigger_error("La fecha no se ha introducido correctamente, el formato es el siguiente : YYYY-MM-DD",E_USER_WARNING);
        return [$clientes,$fechaInicio,$fechaFinal];
    }

    function verificarFecha($fecha)
    {
        $correcto = true;
        $regex = '/^((((\d{4})-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))|((\d{4})-(0[13-9]|1[0-2])-(0[1-9]|[12]\d|30))|((\d{4})-02-(0[1-9]|1\d|2[0-8])))|((\d{4})-02-29))$/';
        if(!preg_match($regex,$fecha))
            $correcto = false;
        return $correcto;
    }

    function mostrarCompras($cliente,$fechaInicio,$fechaFinal)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT UNIDADES , p.NOMBRE as NOMBRE,PRECIO from compra c,producto p where c.NIF = :nif AND c.ID_PRODUCTO = p.ID_PRODUCTO AND FECHA_COMPRA >= :fec_ini AND FECHA_COMPRA <= :fec_final");
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