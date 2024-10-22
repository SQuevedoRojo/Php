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
            $rutaDia = $lasRozas->xpath('/root/prediccion/dia');
            cabeceraTablaTiempo($lasRozas);
            $contador = 0;
            foreach ($rutaDia as $dias) {
                    if($contador == 0)
                        print "<tr><th>Periodo</th>";
                    foreach($dias as $dia)
                    {  
                        if($dia->getName() == 'prob_precipitacion')
                        {
                            print "<th>".$dia['periodo'] ."</th>";
                        }
                    }
                    if($contador == 0)
                    {
                        terminarFilaTiempo();
                        print "<tr><th>Prob. Precipitación</th>";
                    }
                    foreach($dias as $dia)
                    {  
                        if($dia->getName() == 'prob_precipitacion')
                        {
                                print "<th>".$dia ."</th>";
                        }
                    }
                    if($contador == 0)
                    {
                        terminarFilaTiempo();
                        $contador += 1;
                    }
                }
        }
        else
        {
            print "<h3>No se ha encontrado el archivo</h3>";
            die();
        }

    }

    function cabeceraTablaTiempo($xml)
    {
        print "<table border='1'>";
        print "<tr><th>" . $xml->nombre . "</th>";
        for ($i=0; $i < 6; $i++) 
        { 
            $colspan = saberColSpanTiempo($i+1);
            print ("<th colspan='$colspan'>" . $xml->prediccion->dia[$i]['fecha'] . "</th>");
        }
        terminarFilaTiempo();
    }

    function saberColSpanTiempo($posicionDia)
    {
        $colspan = 0;
        switch ($posicionDia) {
            case 1: case 2:
                $colspan = 7;
                break;
            case 3: case 4:
                $colspan = 3;
                break;
            default :
                $colspan = 1;
                break;
        }
        return $colspan;
    }

    function seguirTablaTiempo($valor)
    {
        print "<tr><th>$valor</th>";
    }

    function seguirFilaTiempo($valor)
    {
        print "<th>".$valor ."</th>";
    }

    function terminarFilaTiempo()
    {
        print "</tr>";
    }

    function censo()
    {

    }
?>
</BODY>
</HTML>