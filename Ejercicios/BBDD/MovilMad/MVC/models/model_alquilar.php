<?php

    function saberVehiculosDisponibles()
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT matricula,marca,modelo from rvehiculos where disponible = 'S'");
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

    function saberVehiculosAlquilados($id)
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT count(*) as alquilados from ralquileres where idcliente = :idcliente and fecha_devolucion is null and preciototal is null and fechahorapago is null");
            $stmt->bindParam(':idcliente', $id);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $resultado[0]["alquilados"];
    }

?>