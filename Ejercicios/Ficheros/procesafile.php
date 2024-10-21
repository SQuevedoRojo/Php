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
            $lasRozas = new SimpleXMLElement("..\\..\\..\\gestionFicheros\\pronosticotiempoLasRozas.xml",0,true,"",false);
            //$Madrid = simplexml_load_file("..\\..\\..\\gestionFicheros\\pronosticotiempoMadrid.xml");
            print "<h4>" . $lasRozas->nombre . "    ";
            $rutaDia = $lasRozas->xpath('/root/prediccion/dia');
            cabeceraTablaTiempo($lasRozas);
            foreach ($rutaDia as $dias) {
                foreach ($dias->children() as $dia) {
                    if($dia->getName() == "prob_precipitacion")
                    {
                        print "<tr><th>Periodo</th>";
                        foreach($dia->prob_precipitacion as $precipitacion)
                        {
                            print "<th>".$precipitacion['periodo'] ."</th>";
                        }
                        print "</tr>";
                        print "<tr><th>Prob. Precipitación</th>";
                        foreach($dia->prob_precipitacion as $precipitacion)
                        {
                            print "<th>".$precipitacion ."</th>";
                        }
                        print "</tr>";
                    }
                }
            }
        }
        else
        {
            print "<h3>No se ha encontrado el archivo</h3>";
        }

    }

    function cabeceraTablaTiempo($xml)
    {
        print "<table border='1'>";
        print "<tr><th>" . $xml->nombre . "</th><th rowspan='7'>" . $xml->prediccion->dia[0]['fecha'] . "</th></tr>";
    }

    function censo()
    {

    }
?>
</BODY>
</HTML>