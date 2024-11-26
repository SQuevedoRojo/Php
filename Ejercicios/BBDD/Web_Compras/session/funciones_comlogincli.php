<?php
    include_once "../funciones_comunes.php";
    include_once "funcion_session.php";

    function recogerDatos()
    {
        $usuario = limpiar($_POST['usuario']);
        $contrasena = limpiar($_POST['contrasena']);
        return [$usuario,$contrasena];
    }

    function verificarCliente($usuario,$contrasena)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT NIF,NOMBRE,REVERSE(APELLIDO) as APELLIDO from cliente where NOMBRE = :nombre and APELLIDO = :ape");
            $stmt->bindParam(':nombre', $usuario);
            $apellido = strrev($contrasena);
            $stmt->bindParam(':ape', $apellido);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if($resultado == null)
            {
                trigger_error("No existe ningun usuario con esas claves de acceso",E_USER_WARNING);
            }
            else
            {   
                $nif = $resultado[0]["NIF"];
                if($usuario == $resultado[0]["NOMBRE"] && $contrasena == $resultado[0]["APELLIDO"])
                {
                    iniciarSession();
                    crearSession($nif);
                    header("Location: ./menuOpcionesClientes.php");
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
?>