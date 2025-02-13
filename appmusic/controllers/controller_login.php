<?php
    require_once ("controller_session.php");
    require_once ("controller_comunes.php");
    iniciarSession();
    if(verificarSessionExistente())
        header("Location: controllers/controller_welcome.php");
    elseif($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $usu = $_POST["usu"];
        $contra = $_POST["contra"];
        require_once ("models/model_login.php");
        $resultado = comprobarLogin($usu,$contra);
        if($resultado == null)
            trigger_error("Login Incorrecto");
        else
        {
            $idCli = $resultado[0]["CustomerId"];
            crearSession($idCli);
            header("Location: controllers/controller_welcome.php");
        }
    }

    require_once "views/view_login.php";
?>