<?php

    function saberDepartamentos()
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT dept_name from departments");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $resultado[0];
    }

    function saberCargos()
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT DISTINCT title as title from titles");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $resultado[0];
    }

?>