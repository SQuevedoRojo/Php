<?php
    include_once "funciones_comunes.php";
    include_once "funcion_cookie.php";

    function recogerDatos()
    {
        $producto = limpiar($_POST['productos']);
        $unidades = intval(limpiar($_POST['unidades']));
        if($unidades < 1)
            trigger_error("Las unidades para comprar deben ser mayor a 0",E_USER_WARNING);
        return [$producto,$unidades];
    }

    function imprimirProductos()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT ID_PRODUCTO,NOMBRE FROM producto");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach ($resultado as $row)
            {
                print "<option value=".$row["ID_PRODUCTO"].">".$row["NOMBRE"]."</option>";
            }
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function annadirCestaCompra($producto,$unidad)
    {
        annadirCestaCompra($producto,$unidad);
    }
?>