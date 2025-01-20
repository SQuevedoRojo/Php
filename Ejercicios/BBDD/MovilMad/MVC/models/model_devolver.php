<?php

    function saberVehiculosAlquilados($id)
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT v.matricula,marca,modelo from rvehiculos v,ralquileres a where disponible = 'N' and idcliente=:idcliente and v.matricula = a.matricula;");
            $stmt->bindParam(':idcliente', $id);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $resultado;
    }


    function saberValoresDevolucion($matricula,$id)
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT preciobase from rvehiculos where matricula = :mat");
            $stmt->bindParam(':mat', $matricula);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            $precioBase = ($resultado[0]["preciobase"]);
            $stmt = $GLOBALS["conn"]->prepare("SELECT  TIMESTAMPDIFF(MINUTE,fecha_alquiler,now()) as tiempo from ralquileres where matricula = :mat and idcliente = :idcliente");
            $stmt->bindParam(':mat', $matricula);
            $stmt->bindParam(':idcliente', $id);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            $tiempoTranscurrido = ($resultado[0]["tiempo"]);
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $precioBase * $tiempoTranscurrido;
    }

    function saberSiguienteNumeroPago()
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT (max(num_pago) + 1) as numpago from ralquileres");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $resultado[0]["numpago"];
    }

    function insertarPago($precioCompra,$aceptado)
    {
        $matricula = devolverMatricula();
        $id = devolverId();
        $numPago=saberSiguienteNumeroPago();
        if($aceptado == true)
        {
            $stmt = $GLOBALS["conn"]->prepare("UPDATE ralquileres set fecha_devolucion = now(),preciototal=:precio,fechahorapago=now(),numpago=:numpago where matricula = :mat and idcliente=:id");
            $stmt->bindParam(':precio', $precioCompra);
            $stmt->bindParam(':numpago', $numPago);
            $stmt->bindParam(':mat', $matricula);
            $stmt->bindParam(':id', $id);
            $stmt -> execute();
            $stmt = $GLOBALS["conn"]->prepare("UPDATE rvehiculos set disponible = 'S' where matricula = :mat");
            $stmt->bindParam(':mat', $matricula);
            $GLOBALS["conn"] -> commit();
        }
        else
        {
            $stmt = $GLOBALS["conn"]->prepare("UPDATE rvehiculos set disponible = 'S' where matricula = :mat");
            $stmt->bindParam(':mat', $matricula);
            $stmt -> execute();
            $stmt = $GLOBALS["conn"]->prepare("UPDATE rclientes set pendiente_pago = (pendiente_pago + :pre) where idcliente = :id");
            $stmt->bindParam(':pre', $precioCompra);
            $stmt->bindParam(':id', $id);
            $stmt -> execute();
            $GLOBALS["conn"] -> commit();
        }
    }
?>