<?php
    function imprimirDepartamentos()
    {
        $conn = conexionBBDD();

        $stmt = $conn->prepare("SELECT cod_dpto,nombre FROM dpto");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
        foreach($resultado as $row) {
            echo "<option value=".$row["cod_dpto"].">".$row["nombre"]."</option>";
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
        $dni = limpiar($_POST['dni']);
        $nombre = limpiar($_POST['nombre_emple']);
        $salario = intval(limpiar($_POST['fecha_nac']));
        $fecha = limpiar($_POST['salario']);
        $dpto = limpiar($_POST['departamentos']);
        return [$dni,$nombre,$salario,$fecha,$dpto];
    }

    function limpiar($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function insertarEmpleado($dni,$nombre,$salario,$fecha,$dpto)
    {
        $conn = conexionBBDD();
        try 
        {
            $stmt = $conn->prepare("INSERT INTO emple (dni,nombre,salario,fec_nac) VALUES (:dni,:nombre,:salario,:fec_nac)");
            $stmt->bindParam(':dni', $dni);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':salario', $salario);
            $stmt->bindParam(':fec_nac', $fecha);
            $stmt->execute();
            
            echo "<h2>Empleado creado exitosamente</h2>";
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        finally
        {
            echo "<h2><b>Programa terminado</h2></b>";
        }

        try 
        {
            $stmt = $conn->prepare("INSERT INTO emple_dpto (dni,cod_dpto,fecha_ini) VALUES (:dni,:dpto,curdate())");
            $stmt->bindParam(':dni', $dni);
            $stmt->bindParam(':dpto', $dpto);
            $stmt->execute();

            echo "<h2>Empleado asociado al departamento exitosamente</h2>";
        } catch (PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        finally
        {
            echo "<h2><b>Programa terminado</h2></b>";
        }
        $conn = null;
    }
?>