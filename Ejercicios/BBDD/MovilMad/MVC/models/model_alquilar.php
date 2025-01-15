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

    function realizarAlquiler($cesta,$id)
    {
        try
        {
            $GLOBALS["conn"]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $GLOBALS["conn"]->beginTransaction();
            for ($i=0; $i < count($cesta); $i++)
            { 
                $stmt = $GLOBALS["conn"]->prepare("INSERT INTO ralquileres (idcliente,matricula,fecha_alquiler,fecha_devolucion,preciototal,fechahorapago) values (:idCliente,:matricula,now(),null,null,null)");
                $stmt->bindParam(':idCliente', $id);
                $stmt->bindParam(':matricula', $cesta[$i]);
                $stmt -> execute();
                $stmt = $GLOBALS["conn"]->prepare("UPDATE rvehiculos set disponible = 'N' where matricula = :matricula ");
                $stmt->bindParam(':matricula', $cesta[$i]);
                $stmt -> execute();
            }
            $GLOBALS["conn"] -> commit();
        }
        catch(PDOException $e)
        {
            $GLOBALS["conn"] -> rollBack();
            echo "Error: " . $e->getMessage();
        }
    }
?>