<?php
    include_once "funciones_comunes.php";

    function recogerDatos()
    {
        $nif = limpiar($_POST['nif']);
        $nif =  substr($nif, 0, 8) . strtoupper(substr($nif, 8, 1));
        $nombre = limpiar($_POST['nombre']);
        $apellidos = limpiar($_POST['apellidos']);
        $codPostal = limpiar($_POST['codPos']);
        $direccion = limpiar($_POST['direccion']);
        $ciudad = limpiar($_POST['ciudad']);
        if(!verificarNif($nif))
            trigger_error("El NIF no es correcto",E_USER_WARNING);
        if(!verificarCodigoPostal($codPostal))
            trigger_error("El Codigo Postal no es correcto",E_USER_WARNING);
        return [$nif,$nombre,$apellidos,$codPostal,$direccion,$ciudad];
    }

    function verificarNif($nif)
    {
        $correcto = true;
        $regex = '/^\d{8}[A-Z]$/';
        if(preg_match($regex, $nif))
            $correcto = false;
        return $correcto;
    }

    function verificarCodigoPostal($codPos)
    {
        $correcto = true;
        $regex = '/^((0?[1-9])|([1-4]\d)|(5[0-2]))\d{3}$/';
        if(preg_match($regex,$codPos))
            $correcto = false;
        return $correcto;
    }

    function palabraACapital($data)
    {
        $data = ucwords(strtolower($data));
        return $data;
    }

    function insertarCliente($nif,$nombre,$apellidos,$codPostal,$direccion,$ciudad)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT NIF from cliente where NIF = :nif");
            $stmt->bindParam(':nif', $nif);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if($resultado != null)
            {
                trigger_error("No se puede registar como cliente un NIF ya existente",E_USER_WARNING);
            }
            else
            {
                $nombre = palabraACapital($nombre);
                $apellidos = palabraACapital($apellidos);
                $direccion = palabraACapital($direccion);
                $ciudad = palabraACapital($ciudad);
                
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->beginTransaction();
                $stmt = $conn->prepare("INSERT INTO cliente (NIF,NOMBRE,APELLIDO,CP,DIRECCION,CIUDAD) VALUES (:nif,:nombre,:ape,:codPos,:direc,:ciudad)");
                $stmt->bindParam(':nif', $nif);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':ape', $apellidos);
                $stmt->bindParam(':codPos', $codPostal);
                $stmt->bindParam(':direc', $direccion);
                $stmt->bindParam(':ciudad', $ciudad);
                $stmt->execute();
                $conn -> commit();

                print "<h2>Cliente dado de Alta Correctamente</h2>";
            }

        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
?>