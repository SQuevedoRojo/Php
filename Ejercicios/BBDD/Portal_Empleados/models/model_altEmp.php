<?php

    function saberDepartamentos()
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT dept_name,dept_no from departments order by 2");
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
        return $resultado;
    }

    function altaEmpleado($nombre,$ape,$fecNac,$sal,$genero,$departamento,$cargo)
    {
        $numEmp = saberUltimoNumEmple();
        try
        {
            $GLOBALS["conn"]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $GLOBALS["conn"]->beginTransaction();
            $stmt = $GLOBALS["conn"]->prepare("INSERT INTO employees (emp_no,birth_date,first_name,last_name,gender,hire_date,fecha_baja) values (:numEmp,:fec_Nac,:nombre,:ape,:genero,curdate(),null)");
            $stmt->bindParam(':numEmp', $numEmp);
            $stmt->bindParam(':fec_Nac', $fecNac);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':ape', $ape);
            $stmt->bindParam(':genero', $genero);
            $stmt -> execute();
            $stmt = $GLOBALS["conn"]->prepare("INSERT INTO salaries (emp_no,salary,from_date,to_date) values (:numEmp,:salario,curdate(),null)");
            $stmt->bindParam(':numEmp', $numEmp);
            $stmt->bindParam(':salario', $sal);
            $stmt -> execute();
            $stmt = $GLOBALS["conn"]->prepare("INSERT INTO dept_emp (emp_no,dept_no,from_date,to_date) values (:numEmp,:dept,curdate(),null)");
            $stmt->bindParam(':numEmp', $numEmp);
            $stmt->bindParam(':dept', $departamento);
            $stmt -> execute();
            $stmt = $GLOBALS["conn"]->prepare("INSERT INTO titles (emp_no,title,from_date,to_date) values (:numEmp,:cargo,curdate(),null)");
            $stmt->bindParam(':numEmp', $numEmp);
            $stmt->bindParam(':cargo', $cargo);
            $stmt -> execute();
            $GLOBALS["conn"] -> commit();
        }
        catch(PDOException $e)
        {
            $GLOBALS["conn"] -> rollBack();
            echo "Error: " . $e->getMessage();
        }
    }

    function saberUltimoNumEmple()
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT (max(emp_no) + 1) as emp_no from employees");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $resultado[0]["emp_no"];
    }
?>