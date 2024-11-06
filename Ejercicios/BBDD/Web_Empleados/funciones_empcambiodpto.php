<?php
    function imprimirDepartamentos()
    {
        $conn = conexionBBDD();
        try{
            $stmt = $conn->prepare("SELECT cod_dpto,nombre FROM dpto");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach($resultado as $row) {
                echo "<option value=".$row["cod_dpto"].">".$row["nombre"]."</option>";
            }
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
        $conn = null;
    }

    function imprimirEmpleados()
    {
        $conn = conexionBBDD();
        try{
            $stmt = $conn->prepare("SELECT dni FROM emple");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach($resultado as $row) {
                echo "<option value=".$row["dni"].">".$row["dni"]."</option>";
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
        $dni = ($_POST['empleados']);
        $dpto_anterior = ($_POST['departamento_anterior']);
        $dpto_nuevo = ($_POST['departamento_nuevo']);
        return [$dni,$dpto_anterior,$dpto_nuevo];
    }

    function cambiarEmpleado($dni,$dpto_anterior,$dept_nuevo)
    {
        $conn = conexionBBDD();
        try 
        {
            $stmt = $conn->prepare("SELECT fecha_ini from emple_dpto where dni= :dni and cod_dpto= :dptoAnt and fecha_fi=NULL");
            $stmt->bindParam(':dni', $dni);
            $stmt->bindParam(':dptoAnt', $dpto_anterior);
            $stmt->execute(); 
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            $resultado=$stmt->fetchAll();
            $fecha_inicio = null;
            foreach($resultado as $row) {
                $fecha_inicio = $row["fecha_ini"];
            }

            
            $stmt = $conn->prepare("UPDATE emple_dpto set fecha_fi=curdate() where dni= :dni and cod_dpto= :dptoAnt and fecha_ini = :fecha_inicio");
            $stmt->bindParam(':dni', $dni);
            $stmt->bindParam(':dptoAnt', $dpto_anterior);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->execute();

            $stmt = $conn->prepare("INSERT INTO emple_dpto values (dni,cod_dpto,fecha_ini) VALUES(:dni,:dptoNue,curdate())");
            $stmt->bindParam(':dptoNue', $dept_nuevo);
            $stmt->execute();
            
            echo "<h2>El empleado se ha cambiado de departamento exitosamente</h2>";
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
?>