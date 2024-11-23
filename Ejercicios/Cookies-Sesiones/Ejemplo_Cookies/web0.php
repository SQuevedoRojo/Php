<?php 
    include_once "funcion_cookie.php";
    if(!verificarCookieExistente())
        header("Location: ./login.php");
?>
<html>
    <head><title>Web 0</title></head>
    <body>
        <h2>WEB 0</h2>
        <ul>
            <li><a href="./web1.php">WEB 1</a></li>
            <li><a href="./web2.php">WEB 2</a></li>
        </ul>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <input type="submit" value="Cerrar Sesion">
        </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(isset($_COOKIE["nombreUsuario"]) && isset($_COOKIE["nombreContrasena"]))
                eliminarCookie();
        }
    ?>
    </body>
</html>