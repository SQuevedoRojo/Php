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
                //var_dump($dias);
                $contadorDia = 1;
                foreach ($dias->children() as $dia) {
                    if($contadorDia == 1)
                    {
                        if($contador == 0)
                            print "<tr><th>Periodo</th>";
                        if($dia->getName() == 'prob_precipitacion')
                        {
                            foreach($dia as $precipitacion)
                            {
                                print "<th>".$precipitacion['periodo'] ."</th>";
                            }   
                        }
                        if($contador == 0)
                        {
                            terminarFila();
                            print "<tr><th>Prob. Precipitación</th>";
                        }
                        if($dia->getName() == 'prob_precipitacion')
                        {
                            foreach($dia as $precipitacion)
                            {
                                print "<th>".$precipitacion ."</th>";
                            }
                        }
                        if($contador == 0)
                        {
                            terminarFila();
                            $contador += 1;
                        }
                    }
                    $contadorDia += 1;
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
        print "<tr><th>" . $xml->nombre . "</th>";
        for ($i=0; $i < 6; $i++) 
        { 
            print ("<th colspan='7'>" . $xml->prediccion->dia[$i]['fecha'] . "</th>");
        }
        terminarFila();
    }



    function seguirTabla($valor)
    {
        print "<tr><th>$valor</th>";
    }

    function seguirFila($valor)
    {
        print "<th>".$valor ."</th>";
    }

    function terminarFila()
    {
        print "</tr>";
    }

    function censo()
    {

    }
?>
</BODY>
</HTML>