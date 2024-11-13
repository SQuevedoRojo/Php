<?php
    include_once "funciones_comunes.php";

    function recogerDatos()
    {
        $nombreProducto = limpiar($_POST['nombreProducto']);
        $precioProducto = ($_POST['precioProducto']);
        $categoriaProducto = limpiar($_POST['categoriaProducto']);
        if($precioProducto <= 0)
            trigger_error("El producto no puede tener un precio de 0 o menor",E_USER_WARNING);
        if(strlen($nombreProducto) < 1)
            trigger_error("El nombre del producto no puede estar vacio",E_USER_WARNING);
        return [$nombreProducto,$precioProducto,$categoriaProducto];
    }

    function imprimirCategorias()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT ID_CATEGORIA as id,NOMBRE from categoria");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach ($resultado as $row)
            {
                print "<option value=".$row["id"].">".$row["NOMBRE"]."</option>";
            }
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function insertarProducto($nombreProducto,$precioProducto,$categoriaProducto)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT max(ID_PRODUCTO) as id from producto");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            $codigoNuevo = null;
            if($resultado[0]["id"] == null)
            {
                $codigoNuevo = "P0001";
            }
            else
            {
                $codigoDevuelto = $resultado[0]["id"];
                $numeroCodigo = intval(substr($codigoDevuelto,1)) + 1;
                if($numeroCodigo < 10)
                    $codigoNuevo =  substr($codigoDevuelto,0,1) . "0" . "0" . "0" . strval($numeroCodigo);
                elseif($numeroCodigo < 100)
                    $codigoNuevo =  substr($codigoDevuelto,0,1) . "0". "0". strval($numeroCodigo);
                elseif($numeroCodigo < 1000)
                    $codigoNuevo =  substr($codigoDevuelto,0,1) . "0" . strval($numeroCodigo);
                else
                    $codigoNuevo =  substr($codigoDevuelto,0,1) . strval($numeroCodigo);
            }
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO producto (ID_PRODUCTO,NOMBRE,PRECIO,ID_CATEGORIA) VALUES (:idProducto,:nombre,:precio,:idCategoria)");
            $stmt->bindParam(':idProducto', $codigoNuevo);
            $stmt->bindParam(':nombre', $nombreProducto);
            $stmt->bindParam(':precio', $precioProducto);
            $stmt->bindParam(':idCategoria', $categoriaProducto);
            $stmt->execute();
            $conn -> commit();
            print "<h2>Producto insertado exitosamente</h2>";
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
?>