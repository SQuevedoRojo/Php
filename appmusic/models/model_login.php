<?php
    
    function comprobarLogin($usu,$contra)
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT Email,LastName,CustomerId from employees e,dept_emp d where Email = :usu and LastName = :contra");
            $stmt->bindParam(':usu', $usu);
            $stmt->bindParam(':contra', $contra);
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