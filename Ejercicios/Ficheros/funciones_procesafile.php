<?php
    function opcion($opcion)
    {
        if($opcion == "tiempo")
            tiempo();
        else
            censo();
    }

    function tiempo()
    {
        if(file_exists("..\\..\\..\\gestionFicheros\\pronosticotiempoLasRozas.xml") && file_exists("..\\..\\..\\gestionFicheros\\pronosticotiempoMadrid.xml"))
        {
            $xml1 = new SimpleXMLElement("..\\..\\..\\gestionFicheros\\pronosticotiempoLasRozas.xml",0,true,"",false);
            $xml2 = new SimpleXMLElement("..\\..\\..\\gestionFicheros\\pronosticotiempoMadrid.xml",0,true,"",false);
            $xml = "xml";
            for ($i=1; $i <= 2; $i++) { 
                $Xml = ${$xml . $i};
            
                $rutaDia = $Xml->xpath('/root/prediccion/dia');
                cabeceraTablaTiempo($Xml);
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
                print "<br><br><br>";
            }
        }
        else
            trigger_error("No se encunetran los ficheros para procesar el tiempo");

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
                    print "<th>---</th><th>---</th><th>---</th><th>".$dato->minima ."/". $dato->maxima . "</th><th>---</th><th>---</th><th>---</th>";
                }
                else if($indice == 3 || $indice == 4)
                {
                    print "<th>---</th><th>".$dato->minima ."/". $dato->maxima . "</th><th>---</th>";
                }
                else
                {
                    print "<th>".$dato->minima ."/". $dato->maxima . "</th>";
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
        $indice = 1;
        foreach($datos as $dato)
        {
            if($indice == 1 || $indice == 2)
            {
                print "<th>---</th><th>---</th><th>---</th>";
                foreach($dato->dato as $valores)
                    print "<th>". $valores ."</th>";
            }
            else if($indice == 3 || $indice == 4)
            {
                print "<th>---</th><th>". $dato->minima ."/". $dato->maxima ."</th><th>---</th>";
            }
            else
            {
                print "<th>". $dato->minima ."/". $dato->maxima ."</th>";
            }
            $indice += 1;
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
        if(file_exists("..\\..\\..\\gestionFicheros\\CensoProvinciaHombresMujeres.txt") && file_exists("..\\..\\..\\gestionFicheros\\CensoProvinciaHombresMujeres.csv"))
        {
            $censo1 = file("..\\..\\..\\gestionFicheros\\CensoProvinciaHombresMujeres.txt");
            $censo2 = file("..\\..\\..\\gestionFicheros\\CensoProvinciaHombresMujeres.csv");
            $censo = "censo";
            $caracterDelimitador = "";
            for ($i=1; $i <= 2; $i++) { 
                $Censo = ${$censo . $i};
                if($i == 1)
                    $caracterDelimitador = ',';
                else
                    $caracterDelimitador = ';';
                separarLineas($Censo,$i);
            }
        }
        else
            trigger_error("No se encunetran los ficheros para procesar el censo");
    }

    function separarLineas(&$Censo,$archivo)
    {
        if($archivo == 1)
            separarLineas1($Censo);
        else
            separarLineas2($Censo);
    }

    function separarLineas1(&$Censo)
    {
        $indice = 1;
        foreach ($Censo as $linea => &$contenido) {
            print $contenido . "<br>";
            if($indice == 6)
                imprimirCabeceraArchivo1Censo($contenido);
            else if($indice > 6)
                imprimirLineasenTablaArchivo1($contenido);
            $indice += 1;
        }
    }

    function separarLineas2(&$Censo)
    {
        foreach ($Censo as $linea => &$contenido) {
            imprimirLineasenTablaArchivo2($contenido);
        }
    }

    function imprimirCabeceraArchivo1Censo(&$linea)
    {
        $contenido = explode(",",$linea);
        print "<table border='1'>";
        print "<tr></tr>";
    }

    function imprimirLineasenTablaArchivo1($linea)
    {

    }

    function imprimirLineasenTablaArchivo2($linea)
    {

    }
?>