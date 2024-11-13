<?php
    include_once "funciones_comunes.php";

    function recogerDatos()
    {
        $producto = $_POST['productos'];
        return $producto;
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

    function MostrarProductosEnAlmacen($producto)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT LOCALIDAD, p.NOMBRE as NOMRBE,CANTIDAD from almacena a,almacen al,producto p where a.NUM_ALMACEN = al.NUM_ALMACEN AND a.ID_PRODUCTO = p.ID_PRODUCTO AND  p.ID_PRODUCTO = :idProducto order by LOCALIDAD");
            $stmt->bindParam(':idProducto', $producto);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if($resultado != null)
            {
                print "<table border='1'";
                foreach ($resultado as $row) {
                    print "<tr><th>".$row["LOCALIDAD"]."</th><th>".$row["NOMRBE"]."</th><th>".$row["CANTIDAD"]."</th></tr>";
                }
                print "</table>";
            }
            else
                print "<h2>No hay ningun producto en los almacenes</h2>";

        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
?>