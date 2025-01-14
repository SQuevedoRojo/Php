<?php
    include_once "funciones_comunes.php";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["agregar"]))
        {
            $vehiculos = recogerDatos();
        }
    }

    function recogerDatos()
    {
        $matricula = $_POST["vehiculos"];
        return $matricula;
    }

    function saberVehiculosDisponibles()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT matricula,marca,modelo from rvehiculos where disponible = 'S'");
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

    function imprimirVehiculosDisponibles()
    {
        $cochesDisponibles = saberVehiculosDisponibles();
        foreach ($cochesDisponibles as $coche) {
            print "<option value='".$coche["matricula"]."'>".$coche["matricula"]." | ".$coche["marca"]." | ".$coche["modelo"]."</option>";
        }
    }
?>