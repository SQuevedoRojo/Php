<?php include_once "funcion_sesiones.php";

    if(!verificarSessionActiva())
        header("Location: login.php");

?>
<html>
    <head><title>Web 1</title></head>
    <body>
        <h2>WEB 1</h2>
        <ul>
            <li><a href="./web0.php">WEB 0</a></li>
            <li><a href="./web2.php">WEB 2</a></li>
        </ul>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <input type="submit" value="Cerrar Sesion">
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(isset($_SESSION["usuario"]) && isset($_SESSION["contrasena"]))
                eliminarSession();
        }
    ?>
    </body>
</html>