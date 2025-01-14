<?php

    include_once "funciones_comunes.php";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["volver"]))
            header("Location: movwelcome.php");
        if(isset($_POST["consultar"]))
        {
            list($fechaInicio,$fechaFinal) = recogerDatos();
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
?>