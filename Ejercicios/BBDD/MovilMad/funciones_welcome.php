<?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["alquilar"]))
        {
            header("Location: movalquilar.php");
        }
        if(isset($_POST["consultar"]))
        {
            header("Location: movconsultar.php");
        }
        if(isset($_POST["devolver"]))
        {
            header("Location: movdevolver.php");
        }
    }

?>