<?php

    include_once "funciones_comunes.php";

    function recogerDatos()
    {
        $fecha1 = limpiar($_POST["fecha1"]);
        $fecha2 = limpiar($_POST["fecha2"]);
        if(!(verificarFecha($fecha1)) || !verificarFecha($fecha2))
            trigger_error("La fecha no se ha introducido correctamente, el formato es el siguiente : YYYY-MM-DD",E_USER_WARNING);
        return [$fecha1,$fecha2];
    }

    function verificarFecha($fecha)
    {
        $correcto = true;
        $regex = '/^((((\d{4})-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))|((\d{4})-(0[13-9]|1[0-2])-(0[1-9]|[12]\d|30))|((\d{4})-02-(0[1-9]|1\d|2[0-8])))|((\d{4})-02-29))$/';
        if(!preg_match($regex,$fecha))
            $correcto = false;
        return $correcto;
    }

    function mostrarInformacionProductosVendidos($fecha1,$fecha2)
    {
        
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT orderNumber from orders where orderDate >= :fecha1 and orderDate <= :fecha2");
            $stmt->bindParam(':fecha1', $fecha1);
            $stmt->bindParam(':fecha2', $fecha2);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if($resultado != null)
            {
                foreach ($resultado as $row)
                {
                    $productos = array();
                    $stmt = $conn->prepare("SELECT productName,quantityOrdered from orderdetails o,products p where orderNumber = :numeroPed and o.productCode = p.productCode");
                    $stmt->bindParam(':numeroPed', $row["orderNumber"]);
                    $stmt -> execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $resultado2=$stmt->fetchAll();
                    foreach ($resultado2 as $row2)
                    {
                        if(in_array($row2["productName"],$productos))
                        {
                            $productos[$row2["productName"]] += intval($row2["quantityOrdered"]);
                        }
                        else
                        {
                            $productos[$row2["productName"]] = intval($row2["quantityOrdered"]);
                        }
                    }
                }
                print "<table border='1'><tr><th>Producto</th><th>Cantidades Vendidas</th></tr>";
                foreach ($productos as $nombre => $cantidad) {
                    print "<tr><td>$nombre</td><td>$cantidad</td></tr>";
                }
                print "</table>";
                $conn = null;
            }
            else
            {
                trigger_error("No Hay Informacion Disponible Para Las Fechas Seleccionadas");
            }
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
?>