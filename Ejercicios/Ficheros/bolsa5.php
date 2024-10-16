<HTML>
<H1>Bolsa</H1>
<BODY>
<h1>Bolsa EJ 5</h1>
<form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
    <label for="mostrarTotales">Mostrar : </label>
    <select name="mostrar" id="mostrarTotales" required>
        <option value="7">Total Volumen</option>
        <option value="8">Total Capitalizacion</option>
    </select>
    <br>
    <input type="submit" value="enviar">
    <input type="reset" value="borrar">
</form>
<?php
    include 'funciones_bolsa.php';
?>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $mostrar = $_REQUEST['mostrar'];
        leerFichero5(intval($mostrar));
    }
?>
</BODY>
</HTML>