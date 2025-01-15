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

    require_once ("models/model_alquilar.php");

    $imprimirVehiculos = null;
    if($resultado == null)
        $imprimirVehiculos = "<option value=''>Ningun Coche Alquilado</option>";
    else
    {
        foreach ($cochesDisponibles as $coche) {
            $imprimirVehiculos = $imprimirVehiculos . "<option value='".$coche["matricula"]."'>".$coche["matricula"]." | ".$coche["marca"]." | ".$coche["modelo"]."</option>";
        }
    }
    
    require_once ("views/view_alquilar.php");

?>