<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");    
    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: index.php");
    }
    $id = devolverId();
    $nombre = devolverNombre();
    require_once ("models/model_alquilar.php");
    require_once ("views/view_alquilar.php");

?>