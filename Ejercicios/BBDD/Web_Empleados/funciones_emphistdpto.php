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
        $dpto = ($_POST['departamento']);
        return $dpto;
    }

    function listarHistoricoEmpleado($dept)
    {
        $conn = conexionBBDD();
        try 
        {
            $stmt = $conn->prepare("SELECT DISTINCT(nombre) nombre from emple e,emple_dpto ed where cod_dpto= :dpto and ed.dni= e.dni and fecha_fi is not NULL");
            $stmt->bindParam(':dpto', $dept);
            $stmt->execute(); 
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            print "<ul>";
            foreach($resultado as $row) {
                print "<li>".$row["nombre"]."</li>";
            }
            print "</ul>";
            
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
?>