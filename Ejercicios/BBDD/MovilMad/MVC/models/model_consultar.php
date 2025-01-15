<?php 

    function saberVehiculosAlquiladosPeriodo($fechaInicio,$fechaFinal,$id)
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT v.matricula as matricula,marca,modelo,fecha_devolucion,preciototal from rvehiculos v,ralquileres a where idcliente=:idcliente and v.matricula = a.matricula and DATE(fecha_alquiler) >= :fechaIni and DATE(fecha_devolucion) <= :fechaFin");
            $stmt->bindParam(':idcliente', $id);
            $stmt->bindParam(':fechaIni', $fechaInicio);
            $stmt->bindParam(':fechaFin', $fechaFinal);
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

?>