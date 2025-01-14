<?php
    require_once ("controller_session.php");

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        iniciarSession();
        $usu = $_POST["email"];
        $contra = $_POST["password"];
        require_once ("../models/model_login.php");
        if($resultado[0]["fecha_baja"] == null && $resultado[0]["pendiente_pago"] == 0)
        {
            $idCli = $resultado[0]["idcliente"];
            $nombreCompleto =  $resultado[0]["nombre"] . " " .  $resultado[0]["apellido"];
            crearSession($idCli,$nombreCompleto);
            header("Location: www.google.es");
        }
        elseif($resultado[0]["fecha_baja"] != null)
        {
            trigger_error("Usuario Dado de Baja en el Sistema");
        }
        else
        {
            trigger_error("Usuario con Pagos Pendientes");
        }
    }

    require_once "views/view_login.php";
?>