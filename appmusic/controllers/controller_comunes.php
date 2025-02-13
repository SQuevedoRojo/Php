<?php

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


?>