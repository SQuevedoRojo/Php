<?php

    require_once ("../db/db.php");
    require_once ("controller_session.php");
    require_once ("controller_comunes.php");  

    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: ../index.php");
    }
    $id = devolverId();
    $nombre = devolverNombre();

    var_dump($_SESSION);

    require_once ("../models/model_consultar.php");

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["consultar"]))
        {
            list($fechaIni,$fechaFin) = recogerDatos();
            if($fechaIni != null && $fechaFinal != null)
                $resultado = saberVehiculosAlquiladosPeriodo($fechaIni,$fechaFinal,$id);
            else
                trigger_error("Introduce Fechas Correctas");
        }
        if(isset($_POST["volver"]))
        {
            header("Location: controller_welcome.php");
        }
    }

    function recogerDatos()
    {
        $fechaInicio = $_POST["fechadesde"]; 
        $fechaFinal = $_POST["fechahasta"]; 
        return [$fechaInicio,$fechaFinal];
    }

    require_once ("../views/view_consultar.php");

?>