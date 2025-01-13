<?php
    include_once "movconfig.php";

    function customError($errno, $errstr) {
        echo "<b>Error:</b> [$errno] $errstr<br>";
        echo "Ending Script";
        die();
    }

    function limpiar($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    set_error_handler("customError",E_USER_WARNING);

    function errores($errno, $errstr) {
        echo "<b>$errstr</b>";
    }

    set_error_handler("errores");

    function conexionBBDD()
    {
        $conn = null;

        try {
            $conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE."",DB_USERNAME, DB_PASSWORD);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }

?>