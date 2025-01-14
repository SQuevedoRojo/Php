<?php
    include_once "funciones_comunes.php";
    include_once "funciones_session.php";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["agregar"]))
        {
            $matricula = recogerDatos();
            annadirALaCesta($matricula);
            header("Refresh: 0");
        }
    }

    function recogerDatos()
    {
        $matricula = $_POST["vehiculos"];
        return $matricula;
    }
?>