<?php
    include_once "funciones_comunes.php";

    function recogerDatos()
    {
        $localidad = limpiar($_POST['localidad']);
        if(strlen($localidad) < 1)
            trigger_error("La localidad no puede estar vacio",E_USER_WARNING);
        return $localidad;
    }

    function insertarAlmacen($localidad)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT LOCALIDAD FROM almacen");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach ($resultado as $row)
            {
                if(ucwords(strtolower($row["LOCALIDAD"])) == ucwords(strtolower($localidad)))
                    trigger_error("Ya se ha insertado la localidad",E_USER_WARNING);
            }
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO almacen (LOCALIDAD) VALUES (:localidad)");
            $stmt->bindParam(':localidad', ucwords(strtolower($localidad)));
            $stmt->execute();
            $conn -> commit();
            print "<h2>Almacen insertado exitosamente</h2>";
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
?>