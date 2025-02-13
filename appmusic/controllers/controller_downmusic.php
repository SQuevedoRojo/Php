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
    require_once("../db/db.php");
    require_once("../models/model_downmusic.php");
    $indice = devolverIndice();
    $cancionesDevueltas = false;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["aumentarIndice"]))
        {
            aumentarIndice();
            $indice = devolverIndice();
            $canciones = recuperarListadoCanciones($indice);
            $cancionesDevueltas = true;
        }
        elseif(isset($_POST["disminuirIndice"]))
        {
            disminuirIndice();
            $indice = devolverIndice();
            $canciones = recuperarListadoCanciones($indice);
            $cancionesDevueltas = true;
        }
    }

    if(!$cancionesDevueltas)
    {
        $indice = devolverIndice();
        $canciones = recuperarListadoCanciones($indice);
    }
    require_once "../views/view_downmusic.php";
?>