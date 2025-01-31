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
    

    function saberVidaLaboral($empleado)
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT e.emp_no as emp_no, e.birth_date as birth_date, e.first_name as first_name, e.last_name as last_name, e.gender as gender, e.hire_date as hire_date, e.fecha_baja as fecha_baja,GROUP_CONCAT(DISTINCT s.salary order by s.to_date desc) AS salaries,GROUP_CONCAT(DISTINCT t.title order by t.to_date desc) AS titles,de.dept_no as dept_no,GROUP_CONCAT(DISTINCT d.dept_name order by de.to_date desc) AS dept_names FROM employees e JOIN salaries s ON e.emp_no = s.emp_no JOIN titles t ON e.emp_no = t.emp_no JOIN dept_emp de ON e.emp_no = de.emp_no JOIN departments d ON de.dept_no = d.dept_no WHERE e.emp_no = :emp GROUP BY e.emp_no, e.birth_date, e.first_name, e.last_name, e.gender, e.hire_date, e.fecha_baja, de.dept_no ORDER BY MAX(s.to_date) DESC, MAX(t.to_date) DESC, MAX(de.to_date) DESC;");
            $stmt->bindParam(':emp', $empleado);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $resultado;
    }
?>