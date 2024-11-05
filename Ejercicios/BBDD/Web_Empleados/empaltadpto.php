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
        $codigoDevuelto = null;
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
        foreach($resultado as $row) {
           $codigoDevuelto = $row["cod_dpto"];
        }
        $numeroCodigo = intval(substr($codigoDevuelto,1)) + 1;
        if($numeroCodigo < 10)
            $codigoNuevo =  substr($codigoDevuelto,0,1) . "0" . "0" . strval($numeroCodigo);
        elseif($numeroCodigo < 100)
            $codigoNuevo =  substr($codigoDevuelto,0,1) . "0". strval($numeroCodigo);
        else
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
        
            echo "<h2>Departamento creado exitosamente</h2>";
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        finally
        {
            echo "<h2><b>Programa terminado</h2></b>";
        }
        $conn = null;
    }

    $nombre = recogerDatos();
    $conn = conexionBBDD();
    $cod_dpto=obtenerDepartamento($conn);
    insertarDepartamento($conn,strtoupper($nombre),$cod_dpto);
?>