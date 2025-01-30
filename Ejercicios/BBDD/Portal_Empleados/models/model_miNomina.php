<?php

    function saberVidaLaboral($empleado)
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT e.emp_no,birth_date,first_name,last_name,gender,hire_date from employees e where e.emp_no = :empleado");
            $stmt->bindParam(':empleado', $empleado);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $infoPerosnal=$stmt->fetchAll();
            $stmt = $GLOBALS["conn"]->prepare("SELECT salary from salaries s where s.emp_no = :empleado order by 1 desc limit 1");
            $stmt->bindParam(':empleado', $empleado);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $salarios = $stmt->fetchAll();
            $stmt = $GLOBALS["conn"]->prepare("SELECT title from titles t where t.emp_no = :empleado order by 1 desc limit 1");
            $stmt->bindParam(':empleado', $empleado);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $titulaciones = $stmt->fetchAll();
            $stmt = $GLOBALS["conn"]->prepare("SELECT d.dept_no,dept_name from dept_emp d,departments de where d.emp_no = :empleado and d.dept_no = de.dept_no order by 1 desc limit 1");
            $stmt->bindParam(':empleado', $empleado);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $departamentos = $stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return [$infoPerosnal,$salarios,$titulaciones,$departamentos];
    }

?>