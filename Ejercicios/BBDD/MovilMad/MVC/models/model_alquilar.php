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

?>