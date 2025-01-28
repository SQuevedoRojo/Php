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

    function modificarSalario($empleado,$salario)
    {
        try
        {
            $GLOBALS["conn"]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $GLOBALS["conn"]->beginTransaction();
            $stmt = $GLOBALS["conn"]->prepare("UPDATE salaries set to_date = curdate() where emp_no = :numEmp and to_date is null");
            $stmt->bindParam(':numEmp', $empleado);
            $stmt -> execute();
            $stmt = $GLOBALS["conn"]->prepare("INSERT INTO salaries (emp_no,salary,from_date,to_date) values (:numEmp,:salario,curdate(),null)");
            $stmt->bindParam(':numEmp', $empleado);
            $stmt->bindParam(':salario', $salario);
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