<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");
    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: ../index.php");
    }
    var_dump($_SESSION);

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["facturas"]))
        {
            $idCliente = devolverId();
            $fechaInicio = $_POST["fechadesde"];
            $fechaFinal = $_POST["fechahasta"];
            require_once("../db/db.php");
            require_once("../models/model_facturas.php");
            $datosFacturas =  recuperarDatosCompra($idCliente,$fechaInicio,$fechaFinal);
        }
    }

    require_once("../views/view_facturas.php");

?>