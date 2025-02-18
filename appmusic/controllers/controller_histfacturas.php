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
            require_once("../db/db.php");
            require_once("../models/model_histfacturas.php");
            $datosFacturas =  recuperarDatosCompra($idCliente);
        }
    }

    require_once("../views/view_histfacturas.php");

?>