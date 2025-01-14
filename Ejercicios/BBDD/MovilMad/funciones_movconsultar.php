<?php

    include_once "funciones_comunes.php";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["volver"]))
            header("Location: movwelcome.php");
        if(isset($_POST["consultar"]))
        {
            list($fechaInicio,$fechaFinal) = recogerDatos();
            if($fechaInicio != null && $fechaFinal != null)
                imprimirVehiculosAlquiladosPeriodo($fechaInicio,$fechaFinal);
            else
                trigger_error("Introduce Fechas Correctas");
        }
    }

    function recogerDatos()
    {
        $fechaInicio = $_POST["fechadesde"];
        $fechaFinal = $_POST["fechahasta"];
        return [$fechaInicio,$fechaFinal];
    }

    function saberVehiculosAlquiladosPeriodo($fechaInicio,$fechaFinal)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT v.matricula as matricula,marca,modelo,fecha_devolucion,preciototal from rvehiculos v,ralquileres a where idcliente=:idcliente and v.matricula = a.matricula and (:fechaIni >= DATE(fecha_alquiler) and DATE(fecha_devolucion) <= :fechaFin)");
            $stmt->bindParam(':idcliente', $_SESSION["cliente"]["id"]);
            $stmt->bindParam(':fechaIni', $fechaInicio);
            $stmt->bindParam(':fechaFin', $fechaFinal);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $resultado;
    }
    
    function imprimirVehiculosAlquiladosPeriodo($fechaInicio,$fechaFinal)
    {
        $resultado = saberVehiculosAlquiladosPeriodo($fechaInicio,$fechaFinal);
        if($resultado == null)
            print "<h2>No Ha Tenido Alquilado Ningun Vehiculo</h2>";
        else
        {
            print "<table border='1'>";
            print "<tr><th>Matricula</th><th>Marca</th><th>Modelo</th><th>Fecha Devolucion</th><th>Precio Total</th></tr>";
            foreach ($resultado as $coche) {
                print "<tr><td>".$coche["matricula"]."</td><td>".$coche["marca"]."</td><td>".$coche["modelo"]."</td><td>".$coche["fecha_devolucion"]."</td><td>".$coche["preciototal"]."€</td></tr>";
            }
            print "</table>";
        }
    }
?>