<?php

    function saberEmpleadosExistentes()
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT emp_no, CONCAT(first_name, ' ',last_name) as nombre from employees order by 1");
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

    function darBajaEmpleado($emp)
    {
        try
        {
            $GLOBALS["conn"]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $GLOBALS["conn"]->beginTransaction();
            $stmt = $GLOBALS["conn"]->prepare("UPDATE employees set fecha_baja = curdate() where emp_no = :numEmp");
            $stmt->bindParam(':numEmp', $emp);
            $stmt -> execute();
            $GLOBALS["conn"] -> commit();
        }
        catch(PDOException $e)
        {
            $GLOBALS["conn"] -> rollBack();
            echo "Error: " . $e->getMessage();
        }
    }

?>