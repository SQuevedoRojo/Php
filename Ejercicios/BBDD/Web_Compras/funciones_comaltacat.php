<?php
    include_once "funciones_comunes.php";

    function recogerDatos()
    {
        $nombreCategoria = limpiar($_POST['categoria']);
        return $nombreCategoria;
    }

    function insertarCategoria($nombreCategoria)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT max(ID_CATEGORIA) as id from categoria");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            $codigoNuevo = null;
            if($resultado[0]["id"] == null)
            {
                $codigoNuevo = "C001";
            }
            else
            {
                $codigoDevuelto = $resultado[0]["id"];
                $numeroCodigo = intval(substr($codigoDevuelto,1)) + 1;
                if($numeroCodigo < 10)
                    $codigoNuevo =  substr($codigoDevuelto,0,1) . "0" . "0" . strval($numeroCodigo);
                elseif($numeroCodigo < 100)
                    $codigoNuevo =  substr($codigoDevuelto,0,1) . "0". strval($numeroCodigo);
                else
                    $codigoNuevo =  substr($codigoDevuelto,0,1) . strval($numeroCodigo);
            }
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO categoria (ID_CATEGORIA,NOMBRE) VALUES (:id,:nombre)");
            $stmt->bindParam(':id', $codigoNuevo);
            $stmt->bindParam(':nombre', $nombreCategoria);
            $stmt->execute();
            $conn -> commit();
            print "<h2>Categoria insertado exitosamente</h2>";
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
?>