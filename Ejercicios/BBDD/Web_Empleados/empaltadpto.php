<?php
    function recogerDatos()
    {
        $nombre = limpiar($_POST['nombre_dpto']);
        return $nombre;
    }

    function limpiar($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
            echo "Connected successfully"; 
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }

    function obtenerDepartamento($conn)
    {
        $stmt = $conn->prepare("SELECT cod_dpto FROM dpto");
        $codigoDevuelto = -1;
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
        foreach($resultado as $row) {
           $codigoDevuelto = $row["cod_dpto"];
        }
        $numeroCodigo = intval(substr($codigoDevuelto,strlen($codigoDevuelto)-(strlen($codigoDevuelto)-1))) + 1;
        $codigoNuevo =  substr($codigoDevuelto,0,1) . strval($numeroCodigo);
        return $codigoNuevo;
    }

    function insertarDepartamento($conn,$nombre,$codigo)
    {

        try 
        {
            $stmt = $conn->prepare("INSERT INTO dpto (cod_dpto,nombre) VALUES (:cod_dpto,:nombre)");
            $stmt->bindParam(':cod_dpto', $codigo);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
        
            echo "Departamento creado exitosamente";
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    $nombre = recogerDatos();
    $conn = conexionBBDD();
    $cod_dpto=obtenerDepartamento($conn);
    insertarDepartamento($conn,$nombre,$cod_dpto);
?>