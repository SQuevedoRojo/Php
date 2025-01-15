<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");    
    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: index.php");
    }
    $id = devolverId();
    $nombre = devolverNombre();
    date_default_timezone_set('GMT');
    $fecha = (date('d') ."/".date('m')."/".date('Y')."  ".(date('H')+1).":".date('i')); 

    var_dump($_SESSION);

    require_once ("models/model_alquilar.php");

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["agregar"]))
        {
            $matricula = recogerDatos();
            if($matricula != "")
            {
                annadirVehiculosALaCesta($matricula);
                header("Refresh: 0");
            }
        }
        if(isset($_POST["alquilar"]))
        {
            null;
        }
        if(isset($_POST["vaciar"]))
        {
            null;
        }
    }

    function recogerDatos()
    {
        $matricula = $_POST["vehiculos"];
        return $matricula;
    }
    
    $resultado = saberVehiculosDisponibles();
    $imprimirVehiculos = null;
    if($resultado == null)
        $imprimirVehiculos = "<option value=''>Ningun Coche Alquilado</option>";
    else
    {
        foreach ($resultado as $coche) {
            $imprimirVehiculos = $imprimirVehiculos . "<option value='".$coche["matricula"]."'>".$coche["matricula"]." | ".$coche["marca"]." | ".$coche["modelo"]."</option>";
        }
    }

    $tablaCesta = recuperarCesta();

    require_once ("views/view_alquilar.php");

?>