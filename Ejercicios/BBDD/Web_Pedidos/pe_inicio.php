<?php 
    include_once "funcion_session.php";
    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSession();
    }
?>
<html>
    <head><title>Opciones para el cliente</title></head>
    <body>
        <h2>Opciones para el cliente</h2>
        <ul>
            <li><a href="./comprocli.php">Compra de Productos</a></li>
            <li><a href="./comconscli.php">Ver Compras Anteriores</a></li>
        </ul>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <input type="submit" value="Cerrar Sesion">
        </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(verificarSessionExistente())
                eliminarSession();
        }
    ?>
    </body>
</html>