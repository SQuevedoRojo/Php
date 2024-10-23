<HTML>
<H1>Gestion Ficheros</H1>
<BODY>
<h1>Reto 2.2</h1>
<?php
    include 'funciones_procesafile.php';
    include 'funcion_error_procesafile.php';
?>
<form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
<label for="mostrarVal">Mostrar : </label>
    <select name="mostrar" id="mostrarVal" required>
        <option value="tiempo">Tiempo</option>
        <option value="censo">Censo</option>
    </select>
    <br>
    <input type="submit" value="enviar">
    <input type="reset" value="borrar">
</form>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $valor = $_REQUEST['mostrar'];
        opcion($valor);
    }
?>
</BODY>
</HTML>