<?php 
    include_once "funcion_cookie.php";
    if(!verificarCookieExistente())
        header("Location: ./login.php");
?>
<html>
    <head><title>Opciones para el cliente</title></head>
    <body>
        <h2>Opciones para el cliente</h2>
        <ul>
            <li><a href="./comprocli.php">Compra de Productos</a></li>
            <li><a href="./web2.php">WEB 2</a></li>
        </ul>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <input type="submit" value="Cerrar Sesion">
        </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(isset($_COOKIE["nifUsuario"]))
                eliminarCookie();
        }
    ?>
    </body>
</html>