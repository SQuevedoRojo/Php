<?php

    include_once "funciones_comunes.php";

    function recogerDatos()
    {
        $fecha1 = limpiar($_POST["fecha1"]);
        $fecha2 = limpiar($_POST["fecha2"]);
        return [$fecha1,$fecha2];
    }

    function mostrarInformacionPago($fecha1,$fecha2)
    {
        $numeroCliente = $_SESSION["cliente"]["id"];
        $conn = conexionBBDD();
        if($fecha1 == null && $fecha2 == null)
        {
            $stmt = $conn->prepare("SELECT paymentDate,amount from payments where customerNumber = :numCli order by 1 desc");
            $stmt->bindParam(':numCli', $numeroCliente);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            print "<table border='1'><tr><th>Dia Pago</th><th>Cantidad</th></tr>";
            foreach ($resultado as $row) {
                print "<tr><td>".$row["paymentDate"]."</td><td>".$row["amount"]."€</td></tr>";
            }
        }
        else
        {
            try
            {
                $stmt = $conn->prepare("SELECT paymentDate,amount from payments where customerNumber = :numCli and paymentDate >= :fecha1 and paymentDate <= :fecha2");
                $stmt->bindParam(':numCli', $numeroCliente);
                $stmt->bindParam(':fecha1', $fecha1);
                $stmt->bindParam(':fecha2', $fecha2);
                $stmt -> execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $resultado=$stmt->fetchAll();
                if($resultado == null)
                {
                    trigger_error("No hay Informacion en Las Fechas Seleccionadas. Formato de la Fecha -> YYYY-MM-DD");
                }
                else
                {
                    print "<table border='1'><tr><th>Dia Pago</th><th>Cantidad</th></tr>";
                    foreach ($resultado as $row) {
                        print "<tr><td>".$row["paymentDate"]."</td><td>".$row["amount"]."€</td></tr>";
                    }
                }
            }
            catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }
        
    }
?>