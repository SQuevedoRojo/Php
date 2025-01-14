<?php
    include_once "funciones_comunes.php";
    include_once "funciones_session.php";

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
        if($cochesDisponibles == null)
            print "<option value=''>Ningun Coche Alquilado</option>";
        else
        {
            foreach ($cochesDisponibles as $coche) {
                print "<option value='".$coche["matricula"]."'>".$coche["matricula"]." | ".$coche["marca"]." | ".$coche["modelo"]."</option>";
            }
        }
    }

    function annadirVehiculosAAlquilar()
    {
        $vehiculos = devolverCesta();
        if($vehiculos == null)
        {
            trigger_error("No hay Vehiculos en la Cesta");
        }
        else
        {
            $conn = conexionBBDD();
            try
            {
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->beginTransaction();
                for ($i=0; $i < count($vehiculos); $i++)
                { 
                    if(saberVehiculosAlquilados() < 3)
                    {
                        $stmt = $conn->prepare("INSERT INTO ralquileres (idcliente,matricula,fecha_alquiler,fecha_devolucion,preciototal,fechahorapago) values (:idCliente,:matricula,now(),null,null,null)");
                        $stmt->bindParam(':idCliente', $_SESSION["cliente"]["id"]);
                        $stmt->bindParam(':matricula', $vehiculos[$i]);
                        $stmt -> execute();
                        $stmt = $conn->prepare("UPDATE rvehiculos set disponible = 'N' where matricula = :matricula ");
                        $stmt->bindParam(':matricula', $vehiculos[$i]);
                        $stmt -> execute();
                        annadirCuantosVehiculosAlquilados(1);
                        vaciarVehiculoEspecifico($vehiculos[$i]);
                    }
                    else
                    {
                        trigger_error("Se Ha Alcanzado el Limite de Vehiculos Alquilados");
                    }
                }
                $conn -> commit();
            }
            catch(PDOException $e)
            {
                $conn -> rollBack();
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }
    }

    function saberVehiculosClienteAlquilados()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT v.matricula,marca,modelo from rvehiculos v,ralquileres a where disponible = 'N' and idcliente=:idcliente and v.matricula = a.matricula;");
            $stmt->bindParam(':idcliente', $_SESSION["cliente"]["id"]);
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

    function imprimirVehiculosAlquilados()
    {
        $vehiculos = saberVehiculosClienteAlquilados();
        if($vehiculos == null)
            print "<option value=''>Ningun Coche Alquilado</option>";
        else
        {
            foreach ($vehiculos as $coche) {
                print "<option value='".$coche["matricula"]."'>".$coche["matricula"]." | ".$coche["marca"]." | ".$coche["modelo"]."</option>";
            }
        }
    }
?>