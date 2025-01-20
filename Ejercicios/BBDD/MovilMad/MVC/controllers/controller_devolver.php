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

    require_once ("../models/model_devolver.php");

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["devolver"]))
        {
            $vehiculo = recogerDatos();
            if($vehiculo != "")
            {
                $precioTotal = saberValoresDevolucion($vehiculo,$id);
                insertarMatricula($vehiculo);
                $numeroPago = saberSiguienteNumeroPago();
                require_once "controller_redsys.php";
                list($params,$signature) = redireccionarPago($precioTotal);
                eliminarMatricula();
            }
            else
                trigger_error("No Tienes Vehiculos Para Devolver");
        }
        if(isset($_POST["volver"]))
        {
            header("Location: controller_welcome.php");
        }
    }

    function recogerDatos()
    {
        $vehiculo = $_POST["vehiculos"]; 
        return $vehiculo;
    }

    $resultado = saberVehiculosAlquilados($id);

    require_once ("../views/view_devolver.php");

?>