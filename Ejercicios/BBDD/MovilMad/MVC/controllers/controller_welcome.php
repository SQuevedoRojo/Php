<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");    
    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: index.php");
    }
    var_dump($_SESSION);
    $id = devolverId();
    $nombre = devolverNombre();
    require_once ("models/model_welcome.php");
    require_once ("views/view_welcome.php");

?>