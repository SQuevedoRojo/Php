<?php

    function saberEmpleadosExistentes()
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT e.emp_no AS emp_no, CONCAT(e.first_name, ' ', e.last_name) AS nombre, de.dept_no AS dept_no, d.dept_name FROM employees e JOIN dept_emp de ON e.emp_no = de.emp_no JOIN departments d ON de.dept_no = d.dept_no WHERE de.to_date IS NULL AND NOT EXISTS ( SELECT 1 FROM dept_manager dm WHERE dm.emp_no = e.emp_no ) ORDER BY e.emp_no");
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
    
    function saberDepartamentosExistentes()
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT dept_no, dept_name from departments order by 1");
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

    function cambiarDepartamento($emple,$deptAnt,$deptNue)
    {
        try
        {
            $GLOBALS["conn"]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $GLOBALS["conn"]->beginTransaction();
            $stmt = $GLOBALS["conn"]->prepare("UPDATE dept_emp set to_date = curdate() where emp_no = :numEmp and dept_no = :dept and to_date is null");
            $stmt->bindParam(':numEmp', $emple);
            $stmt->bindParam(':dept', $deptAnt);
            $stmt -> execute();
            $stmt = $GLOBALS["conn"]->prepare("INSERT INTO dept_emp (emp_no,dept_no,from_date,to_date) values (:numEmp,:dept,curdate(),null)");
            $stmt->bindParam(':numEmp', $emple);
            $stmt->bindParam(':dept', $deptNue);
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