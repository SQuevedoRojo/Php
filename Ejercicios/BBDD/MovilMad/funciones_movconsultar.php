<?php

    include_once "funciones_comunes.php";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["volver"]))
            header("Location: movwelcome.php");
        if(isset($_POST["consultar"]))
        {
            list($fechaInicio,$fechaFinal) = recogerDatos();
            imprimirVehiculosAlquiladosPeriodo($fechaInicio,$fechaFinal);
        }
    }

    function recogerDatos()
    {
        $fechaInicio = $_POST["fechadesde"];
        $fechaFinal = $_POST["fechahasta"];
        var_dump($fechaInicio);
        var_dump($fechaFinal);
        return [$fechaInicio,$fechaFinal];
    }

    function saberVehiculosAlquiladosPeriodo($fechaInicio,$fechaFinal)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT v.matricula,marca,modelo,fecha_devolucion,preciototal from rvehiculos v,ralquileres a where idcliente=:idcliente and v.matricula = a.matricula and :fechaIni >= DATE(fecha_alquiler) and DATE(fecha_devolucion) <= :fechaFin");
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
                print "<tr><th>".$coche["v.matricula"]."</th><th>".$coche["marca"]."</th><th>".$coche["modelo"]."</th><th>".$coche["fecha_devolucion"]."</th><th>".$coche["preciototal"]."€</th></tr>";
            }
            print "</table>";
        }
    }
?>