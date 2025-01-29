<?php

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


    function saberInformacionDepartamento($dept)
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT dm.emp_no as emp_no, CONCAT(first_name, ' ',last_name) as nombre from dept_manager dm,employees e where dm.dept_no = :dept and dm.emp_no = e.emp_no");
            $stmt->bindParam(':dept', $dept);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $jefe=$stmt->fetchAll();
            $stmt = $GLOBALS["conn"]->prepare("SELECT de.emp_no as emp_no, CONCAT(first_name, ' ',last_name) as nombre from dept_emp de,employees e where de.dept_no = :dept and de.emp_no = e.emp_no and to_date is null");
            $stmt->bindParam(':dept', $dept);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $empleadosTrabajando=$stmt->fetchAll();
            $stmt = $GLOBALS["conn"]->prepare("SELECT de.emp_no as emp_no, CONCAT(first_name, ' ',last_name) as nombre from dept_emp de,employees e where de.dept_no = :dept and de.emp_no = e.emp_no and to_date is not null");
            $stmt->bindParam(':dept', $dept);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $empleadosCambiados=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return [$jefe,$empleadosTrabajando,$empleadosCambiados];
    }
?>