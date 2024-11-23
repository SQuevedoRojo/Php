<?php
    include_once "funciones_comunes.php";
    include_once "funcion_sesiones.php";

    function recogerDatos()
    {
        $usuario = limpiar($_POST['usuario']);
        $contrasena = limpiar($_POST['contrasena']);
        return [$usuario,$contrasena];
    }

    function verificarCuenta($usuario,$contrasena)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT usuario,contrasena from usuarios where usuario = :usuario and contrasena = :cont");
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':cont', $contrasena);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if($resultado != null)
            {
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->beginTransaction();
                $stmt = $conn->prepare("UPDATE usuarios set acceso = now() where usuario = :usuario and contrasena = :cont");
                $stmt->bindParam(':usuario', $usuario);
                $stmt->bindParam(':cont', $contrasena);
                $stmt -> execute();
                $conn -> commit();
                crearCookieSession($usuario,$contrasena);
            }
            else
            {
                print "<h2>Las claves de acceso son incorrectas</h2>";
            }

        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function crearCookieSession($usuario,$contrasena)
    {
        $sessionCreada = false;
        if(!(isset($_SESSION["usuario"]) && isset($_SESSION["contrasena"])))
        {
            iniciarSession($usuario,$contrasena);
            $sessionCreada = true;
        }
        else
        {
            print "<h2>La sesion ya esta creada</h2>";
        }
        if($sessionCreada)
            header("Location: ./web0.php");
    }
?>