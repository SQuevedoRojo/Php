<HTML>
<H1>Bolsa</H1>
<BODY>
<h1>Bolsa EJ 2</h1>
<form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
    Valor Bursatil :<input type="text" name="valor" required><br>
    <input type="submit" value="enviar">
    <input type="reset" value="borrar">
</form>
<?php
    include 'funciones_bolsa.php';
?>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $valor = limpiar($_REQUEST['valor']);
        leerFichero2(strtolower($valor));
    }
?>
</BODY>
</HTML>