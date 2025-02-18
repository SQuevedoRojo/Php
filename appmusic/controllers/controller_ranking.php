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
        if(isset($_POST["ranking"]))
        {
            $idCliente = devolverId();
            $fechaInicio = $_POST["fechadesde"];
            $fechaFinal = $_POST["fechahasta"];
            require_once("../db/db.php");
            require_once("../models/model_ranking.php");
            $datosMusica =  saberMusicaMasDescargada($fechaInicio,$fechaFinal);
        }
    }

    require_once("../views/view_ranking.php");

?>