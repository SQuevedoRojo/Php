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
        elseif($resultado[0]["fecha_baja"] != null)
        {
            trigger_error("Empleado Dado de Baja");
        }
        else
        {
            $idCli = $resultado[0]["emp_no"];
            $dept = $resultado[0]["dept_no"];
            crearSession($idCli,$dept);
            header("Location: controllers/controller_welcome.php");
        }
    }

    require_once "views/view_login.php";
?>