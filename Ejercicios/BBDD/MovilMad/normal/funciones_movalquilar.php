<?php
    include_once "funciones_comunes.php";
    include_once "funciones_session.php";
    include_once "funciones_bbddVehiculos.php";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["agregar"]))
        {
            $matricula = recogerDatos();
            if($matricula != '')
                annadirALaCesta($matricula);
            header("Refresh: 3");
        }
        if(isset($_POST["vaciar"]))
        {
            vaciarCesta();
            header("Refresh: 0");
        }
        if(isset($_POST["alquilar"]))
        {
            annadirVehiculosAAlquilar();
            vaciarCesta();
            header("Refresh: 3");
        }
    }

    function recogerDatos()
    {
        $matricula = $_POST["vehiculos"];
        return $matricula;
    }
?>