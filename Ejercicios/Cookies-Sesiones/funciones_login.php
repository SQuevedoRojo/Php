<?php
    include_once "funciones_comunes.php";
    include_once "funciones_cookie.php";
    function recogerDatos()
    {
        $usuario = limpiar($_POST['ususario']);
        $contraseña = limpiar($_POST['contrasena']);
        return [$usuario,$contraseña];
    }

    function verificarCuenta($usuario,$contraseña)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT usuario,contrasena from usuarios where usuario = :usuario and contrasena = :cont");
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':cont', $contraseña);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if($resultado != null)
            {
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->beginTransaction();
                $stmt = $conn->prepare("UPDATE usuarios set acceso = now() where usuario = :usuario and contrasena = :cont");
                $stmt->bindParam(':usuario', $usuario);
                $stmt->bindParam(':cont', $contraseña);
                $stmt -> execute();
                $conn -> commit();
                crearCookie($usuario,$contraseña);
                header("Location: web0.php");
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
?>