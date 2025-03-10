<?php
    include_once "funciones_comunes.php";
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        list($usu,$contra) = recogerDatos();
        comprobarLogin($usu,$contra);
    }

    function recogerDatos()
    {
        $usu = limpiar($_POST["email"]);
        $contra = limpiar($_POST["password"]);
        return [$usu,$contra];
    }

    function comprobarLogin($usu,$contra)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT idcliente,nombre,apellido,fecha_baja,pendiente_pago from rclientes where idcliente = :contra and email = :usu");
            $stmt->bindParam(':usu', $usu);
            $stmt->bindParam(':contra', $contra);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if($resultado == null)
            {
                trigger_error("Login Erroneo");
            }
            else
            {   
                if($resultado[0]["fecha_baja"] == null && $resultado[0]["pendiente_pago"] == 0)
                {
                    $idCli = $resultado[0]["idcliente"];
                    $nombreCompleto =  $resultado[0]["nombre"] . " " .  $resultado[0]["apellido"];
                    crearSession($idCli,$nombreCompleto);
                    header("Location: ./movwelcome.php");
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
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
?>