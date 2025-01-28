<?php
    
    try
    {
        $stmt = $conn->prepare("SELECT emp_no,last_name,dept_no from employees e,dept_emp d where emp_no = :usu and last_name = :contra and e.emp_no = d.emp_no");
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

?>