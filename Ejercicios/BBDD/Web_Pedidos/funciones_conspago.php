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

    function mostrarInformacionPago($fecha1,$fecha2)
    {
        $numeroCliente = $_SESSION["cliente"]["id"];
        $conn = conexionBBDD();
        if($fecha1 == null && $fecha2 == null)
        {
            $stmt = $conn->prepare("SELECT paymentDate,amount from payments where customerName = :numCli order by 1 desc");
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
                $stmt = $conn->prepare("SELECT paymentDate,amount from payments where customerName = :numCli and paymentDate >= :fecha1 and paymentDate <= :fecha2");
                $stmt->bindParam(':numCli', $numeroCliente);
                $stmt->bindParam(':fecha1', $fecha1);
                $stmt->bindParam(':fecha2', $fecha2);
                $stmt -> execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $resultado=$stmt->fetchAll();
                print "<table border='1'><tr><th>Dia Pago</th><th>Cantidad</th></tr>";
                foreach ($resultado as $row) {
                    print "<tr><td>".$row["paymentDate"]."</td><td>".$row["amount"]."€</td></tr>";
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