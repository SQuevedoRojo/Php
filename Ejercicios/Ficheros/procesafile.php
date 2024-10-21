<HTML>
<H1>Gestion Ficheros</H1>
<BODY>
<h1>Reto 2.2</h1>
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
<?php
    function opcion($opcion)
    {
        if($opcion == "tiempo")
        {
            tiempo();
        }
        else
        {
            censo();
        }
    }

    function tiempo()
    {
        if(file_exists("..\\..\\..\\gestionFicheros\\pronosticotiempoLasRozas.xml") && file_exists("..\\..\\..\\gestionFicheros\\pronosticotiempoMadrid.xml"))
        {
            $lasRozas = fopen("..\\..\\..\\gestionFicheros\\pronosticotiempoLasRozas.xml","r");
            $Madrid = fopen("..\\..\\..\\gestionFicheros\\pronosticotiempoMadrid.xml","r");
            print fread($lasRozas,filesize("..\\..\\..\\gestionFicheros\\pronosticotiempoLasRozas.xml"));
        }
        else
        {
            print "<h3>No se ha encontrado el archivo</h3>";
        }

    }

    function censo()
    {

    }
?>
</BODY>
</HTML>