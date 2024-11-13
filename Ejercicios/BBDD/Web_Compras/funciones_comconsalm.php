<?php
    include_once "funciones_comunes.php";

    function recogerDatos()
    {
        $producto = $_POST['almacenes'];
        return $producto;
    }

    function imprimirAlmacenes()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT NUM_ALMACEN,LOCALIDAD FROM almacen");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach ($resultado as $row)
            {
                print "<option value=".$row["NUM_ALMACEN"].">".$row["LOCALIDAD"]."</option>";
            }
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function MostrarAlmacen($almacen)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT LOCALIDAD, p.NOMBRE as NOMRBE,CANTIDAD from almacena a,almacen al,producto p where a.NUM_ALMACEN = al.NUM_ALMACEN AND a.ID_PRODUCTO = p.ID_PRODUCTO AND  a.NUM_ALMACEN = :idAlmacen");
            $stmt->bindParam(':idAlmacen', $almacen);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if($resultado != null)
            {
                print "<table border='1'>";
                print "<tr><th>ALMACEN</th><th>PRODUCTO</th><th>CANTIDAD</th></tr>";
                foreach ($resultado as $row) {
                    print "<tr><td>".$row["LOCALIDAD"]."</td><td>".$row["NOMRBE"]."</td><td>".$row["CANTIDAD"]."</td></tr>";
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