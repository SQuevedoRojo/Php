<?php
    include_once "funciones_comunes.php";
    include_once "funciones_session.php";

    function recogerDatos()
    {
        $usuario = (limpiar($_POST["nombreUsu"]));
        $nombre = (limpiar($_POST["nombre"]));
        $ape = (limpiar($_POST["apellido"]));
        $tel = (limpiar($_POST["tel"]));
        $dir1 = (limpiar($_POST["dir1"]));
        $ciudad = (limpiar($_POST["ciudad"]));
        $pais = (limpiar($_POST["pais"]));
        return [$usuario,$nombre,$ape,$tel,$dir1,$ciudad,$pais];
    }

    function registrarCliente($usuario,$nombre,$ape,$tel,$dir1,$ciudad,$pais)
    {
        $numeroUsuario = obtenerUltimoId();
        $conn = conexionBBDD();
        try
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO customers (customerNumber, customerName, contactLastName, contactFirstName, phone, addrebLine1, addrebLine2, city, state_code, postalCode, country, salesRepEmployeeNumber, creditLimit, cuentaBloqueada) VALUES (:numUsu, :nomUsu, :ape, :nom, :tel, :dir1, NULL, :ciu, NULL, NULL, :pais, NULL, NULL, 0)");
            $stmt->bindParam(':numUsu', $numeroUsuario);
            $stmt->bindParam(':nomUsu', $usuario);
            $stmt->bindParam(':ape', $ape);
            $stmt->bindParam(':nom', $nombre);
            $stmt->bindParam(':tel', $tel);
            $stmt->bindParam(':dir1', $dir1);
            $stmt->bindParam(':ciu', $ciudad);
            $stmt->bindParam(':pais', $pais);
            $stmt -> execute();
            $conn -> commit();
            print "<h2>Registrado Correctamente</h2>";
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function obtenerUltimoId()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT max(customerNumber) as customerNumber from customers");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            $id = intval($resultado[0]["customerNumber"]) + 1;
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $id;
    }
?>