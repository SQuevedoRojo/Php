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
        cookieCestaCompra($producto,$unidad);
        imprimirCestaCompra();
    }

    function imprimirCestaCompra()
    {
        if(isset($_COOKIE["cestaCompra"]))
        {
            $carritoCompra = $_COOKIE["cestaCompra"];
            $productos = explode("|",$carritoCompra);
            $conn = conexionBBDD();
            print "<div id='carrito'><h2>Carrito de la compra</h2>";
            print "<table border='1'><tr><th>Producto</th><th>Unidades</th></tr>";
            for ($i=0; $i < count($productos) - 1; $i++)
            { 
                $producto = explode(";",$productos[$i]);
                try
                {
                    $stmt = $conn->prepare("SELECT NOMBRE FROM producto where ID_PRODUCTO = :id");
                    $stmt->bindParam(':id', $producto[0]);
                    $stmt -> execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $resultado=$stmt->fetchAll();
                }
                catch(PDOException $e)
                {
                    echo "Error: " . $e->getMessage();
                }
                print "<tr><td>".$resultado[0]["NOMBRE"]."</td><td>".$producto[1]."</td></tr>";
            }
            print "</table></div>";
        }
    }
?>