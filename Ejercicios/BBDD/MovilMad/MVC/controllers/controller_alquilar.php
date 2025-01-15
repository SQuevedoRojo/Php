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
    date_default_timezone_set('GMT');
    $fecha = (date('d') ."/".date('m')."/".date('Y')."  ".(date('H')+1).":".date('i')); 

    var_dump($_SESSION);

    require_once ("../models/model_alquilar.php");

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
            $cesta = devolverCesta();
            if($cesta != null)
            {
                realizarAlquiler($cesta,$id);
                vaciarCesta();
                header("Refresh: 0");
            }
            else
            {
                trigger_error("No Puedes Alquilar Vehiculos con la Cesta Vacia");
            }
        }
        if(isset($_POST["vaciar"]))
        {
            vaciarCesta();
            header("Refresh: 0");
        }
    }

    function recogerDatos()
    {
        $matricula = $_POST["vehiculos"];
        return $matricula;
    }
    
    $resultado = saberVehiculosDisponibles();

    $tablaCesta = recuperarCesta();

    require_once ("../views/view_alquilar.php");

?>