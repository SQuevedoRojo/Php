<?php

    function imprimirEmpleados()
    {
        $conn = conexionBBDD();
        try{
            $stmt = $conn->prepare("SELECT dni,nombre FROM emple");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach($resultado as $row) {
                echo "<option value=".$row["dni"].">".$row["nombre"]."</option>";
            }
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
        $conn = null;
    }

    function conexionBBDD()
    {
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname="empleadosnn";
        $conn = null;

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }

    function recogerDatos()
    {
        $empleado = ($_POST['empleados']);
        $porcentajeSalario = intval(limpiar($_POST['salario']));
        return [$empleado,$porcentajeSalario];
    }

    function limpiar($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function cambiarSalario($empleado,$porcentajeSalario)
    {
        $conn = conexionBBDD();
        try 
        {
            $stmt = $conn->prepare("SELECT salario from emple  where dni=:dni");
            $stmt->bindParam(':dni', $empleado);
            $stmt->execute(); 
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            $salarioOriginal = 0;
            foreach($resultado as $row) {
                $salarioOriginal = intval($row["salario"]);
            }
            
            $salarioActualizado = ($salarioOriginal * ($porcentajeSalario/100)) + $salarioOriginal;

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            $stmt = $conn->prepare("UPDATE emple set salario=:salario where dni= :dni");
            $stmt->bindParam(':dni', $empleado);
            $stmt->bindParam(':salario', $salarioActualizado);
            $stmt->execute(); 
            $conn -> commit();
            print "<h2>Salario Actualizado Exitosamente Con Un Valor de ". $salarioActualizado ."€</h2>";
            
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
?>