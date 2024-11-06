<?php
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
        $fecha = ($_POST['fecha']);
        return $fecha;
    }

    function mostrarTrabajadoresFecha($fecha)
    {
        $conn = conexionBBDD();
        try 
        {
            $stmt = $conn->prepare("SELECT dni,cod_dpto,fecha_ini,fecha_fi from emple_dpto where fecha_ini >=:fecha and fecha_fi<=:fecha");
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute(); 
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            print "<table border='1'>";
            print "<tr><th>DNI</th><th>CODIGO DEPARTAMENTO</th><th>FECHA INCIO</th><th>FECHA FINAL</th></tr>";
            foreach($resultado as $row) {
                $fecha_fin = '';
                if($row["fecha_fi"] == null)
                    $fecha_fi = "Sigue Trabajando en el Departamento";
                else
                    $fecha_fin = $row["fecha_fi"];

                print "<tr><td>".$row["dni"]."</td><td>".$row["cod_dpto"]."</td><td>".$row["fecha_ini"]."</td><td>".$fecha_fin."</td></tr>";
            }
            print "</table>";

            print "<h2>Salario Actualizado Exitosamente</h2>";
            
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
?>