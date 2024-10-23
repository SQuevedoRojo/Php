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
            $mostrarXML = ["prob_precipitacion","viento","temperatura","sens_termica"];
            $mostrarTabla = ["Prob. Precipitación","Viento (km/h)","Sensación Térmica (ºC) ","Temp. Max – Min (ºC)"];
            $probPre = recogerDatosTiempo($rutaDia,$mostrarXML[0]);
            $viento = recogerDatosTiempo($rutaDia,$mostrarXML[1]);
            $temperatura = recogerDatosTiempo($rutaDia,$mostrarXML[2]);
            $senTermica = recogerDatosTiempo($rutaDia,$mostrarXML[3]);
            imprimirPeriodoTiempo($rutaDia,"prob_precipitacion","Periodo");
            imprimirDatosTiempoProbPre($probPre,$mostrarTabla[0]);
            imprimirDatosTiempoViento($viento,$mostrarTabla[1]);
            imprimirDatosTiempoTemp($temperatura,$mostrarTabla[3]);
            imprimirDatosTiempoSen($senTermica,$mostrarTabla[2]);
        }
        else
        {
            print "<h3>No se ha encontrado el archivo</h3>";
            die();
        }

    }

    function imprimirPeriodoTiempo($rutaDia,$mostrar,$mostrarTabla)
    {
        print "<tr><th>$mostrarTabla</th>";
        foreach ($rutaDia as $dias) {
            foreach($dias as $dia)
            {  
                if($dia->getName() == $mostrar)
                {
                    if($dia['periodo'] != null)
                        print "<th>".$dia['periodo'] ."</th>";
                    else
                        print "<th>---</th>";
                }
            }
        }
        terminarFilaTiempo();
    }

    function recogerDatosTiempo($rutaDia,$recoger)
    {
        $datos = array();
        foreach ($rutaDia as $dias) {
            foreach($dias as $dia)
            {  
                if($dia->getName() == $recoger)
                {
                    $datos[] = $dia;
                }
            }
        }
        return $datos;
    }

    function imprimirDatosTiempoProbPre($datos,$mostrar)
    {
        print "<tr><th>$mostrar</th>";
        foreach($datos as $dato)
        {
            if($dato != null)
                print "<th>".$dato[0] ."</th>";
            else
                print "<th>---</th>";
        }
    }

    function imprimirDatosTiempoViento($datos,$mostrar)
    {
        print "<tr><th>$mostrar</th>";
        foreach($datos as $dato)
        {
            print "<th>".$dato->direccion ."  " . $dato->velocidad . "</th>";
        }
    }

    function imprimirDatosTiempoTemp($datos,$mostrar)
    {
        print "<tr><th>$mostrar</th>";
        $indice = 1;
        foreach($datos as $dato)
        {
            if($dato != null)
            {
                if($indice == 1 || $indice == 2)
                {
                    print "<th></th><th></th><th></th><th>".$dato->minima ."/". $dato->maxima . "</th><th></th><th></th><th></th>";
                }
                else
                {
                    print "<th></th><th>".$dato->minima ."/". $dato->maxima . "</th><th></th>";
                }
            }
            else
                print "<th>---</th>";
            $indice += 1;
        }
    }

    function imprimirDatosTiempoSen($datos,$mostrar)
    {
        print "<tr><th>$mostrar</th>";
        foreach($datos as $dato)
        {
            if(count($dato->dato) == 4)
            {
                print "<th></th><th></th><th></th>";
                foreach($dato->dato as $valores)
                print "<th>". $valores ."</th>";
            }
            else
                print "<th>". $dato->minima ."/". $dato->maxima ."</th>";
        }
    }
    
    function cabeceraTablaTiempo($xml)
    {
        print "<table border='1'>";
        print "<tr><th>" . $xml->nombre . "</th>";
        for ($i=0; $i <= 6; $i++) 
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