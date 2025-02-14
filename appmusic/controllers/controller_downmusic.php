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

    $cancionesDevueltas = false;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["aumentarIndice"]))
        {
            aumentarIndice();
            $indice = intval(devolverIndice());
            $canciones = recuperarListadoCanciones($indice);
            $cancionesDevueltas = true;
        }
        elseif(isset($_POST["disminuirIndice"]))
        {
            disminuirIndice();
            $indice = intval(devolverIndice());
            $canciones = recuperarListadoCanciones($indice);
            $cancionesDevueltas = true;
        }
        elseif(isset($_POST["cesta"]))
        {
            $cancion = $_POST["canciones"];
            annadirCancionesALaCesta($cancion);
            header("Refresh: 0");
        }
        elseif(isset($_POST["Ecesta"]))
        {
            vaciarCesta();
            header("Refresh: 0");
        }
        elseif(isset($_POST["descargar"]))
        {

        }
    }

    $cesta = devolverCesta();

    if(!$cancionesDevueltas)
    {
        $indice = intval(devolverIndice());
        $canciones = recuperarListadoCanciones($indice);
    }
    require_once "../views/view_downmusic.php";
?>