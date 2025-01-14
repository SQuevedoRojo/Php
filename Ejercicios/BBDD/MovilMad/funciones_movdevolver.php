<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["volver"]))
            header("Location: movwelcome.php");
    }

?>