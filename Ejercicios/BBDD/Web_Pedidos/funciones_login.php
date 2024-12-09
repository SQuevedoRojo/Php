<?php
    include_once "funciones_comunes.php";
    include_once "funciones_session.php";

    function recogerDatos()
    {
        $usuario = intval(limpiar($_POST['usuario']));
        $contrasena = password_hash(limpiar($_POST['contrasena']),PASSWORD_DEFAULT);
        return [$usuario,$contrasena];
    }

    function verificarCliente($usuario,$contrasena)
    {
        iniciarSession();
        crearSession($usuario);
        if(saberIntentosSesion($usuario) != 3)
        {
            $conn = conexionBBDD();
            try
            {
                $stmt = $conn->prepare("SELECT customerNumber,contactLastName from customers where customerNumber = :usuario and contactLastName = :contrasena");
                $stmt->bindParam(':usuario', $usuario);
                $stmt->bindParam(':contrasena', $contrasena);
                $stmt -> execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $resultado=$stmt->fetchAll();
                if($resultado == null)
                {
                    trigger_error("No existe ningun usuario con esas claves de acceso");
                    intentosInicioSesion($usuario);
                }
                else
                {   
                    if($usuario == $resultado[0]["customerNumber"] && password_verify($resultado[0]["contactLastName"],$contrasena))
                    {
                        $idCli = $resultado[0]["customerNumber"];
                        iniciarSession();
                        header("Location: ./pe_inicio");
                    }
                    
                }

            }
            catch(PDOException $e)
            {
                $conn -> rollBack();
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }
        else
        {
            $conn = conexionBBDD();
            try
            {
                $stmt = $conn->prepare("UPDATE customers set cuentaBloqueada = 1 where customerNumber = :usuario");
                $stmt->bindParam(':usuario', $usuario);
                $stmt -> execute();
                $conn -> commit();
            }
            catch(PDOException $e)
            {
                $conn -> rollBack();
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
            trigger_error("Cuenta Bloqueada por Inicios de Sesion Erroneos",E_USER_WARNING);
        }
    }
?>