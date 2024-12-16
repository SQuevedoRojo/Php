<?php 
    include_once "funciones_session.php";
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
            <li><a href="./pe_altaped.php">Compra de Productos</a></li>
            <li><a href="./pe_consped.php">Consultar Informacion Clientes</a></li>
            <li><a href="./pe_consprodstock.php">Consultar Stock Producto</a></li>
            <li><a href="./pe_constock.php">Consultar Stock de Tipo de Producto</a></li>
            <li><a href="./pe_topprod.php">Mostrar Productos Vendidos Entre Dos Fechas</a></li>
            <li><a href="./pe_conspago.php">Consultar Informacion Pago Clientes</a></li>
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