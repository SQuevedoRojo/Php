<?php
    //Funcion para terminar el programa si no se dan los datos necesarios en el formulario
    function customError($errno, $errstr) {
        echo "<b>Error:</b> [$errno] $errstr<br>";
        echo "Terminando Programa";
        die();
    }

    set_error_handler("customError",E_USER_WARNING);

?>