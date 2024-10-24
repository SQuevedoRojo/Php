<?php
    // Funcion principal encargada de procesar los archivos de Tiempo o Censo segun la opcion elegida por el usuario
    function opcion($opcion)
    {
        if($opcion == "tiempo")
            tiempo();
        else
            censo();
    }

    //Funcion principal del procesamiento del tiempo encargada de mostrar los datos en una tabla
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
    
    //Funcion que imprimie el periodo de las horas de la probabilidad de precipitacion
    function imprimirPeriodoTiempo($rutaDia,$mostrar,$mostrarTabla)
    {
        print "<tr><th>$mostrarTabla</th>";
        foreach ($rutaDia as $dias) {
            foreach($dias as $dia)
            {  
                if($dia->getName() == $mostrar)
                {
                    if($dia['periodo'] != null)
                        print "<td>".$dia['periodo'] ."</td>";
                    else
                        print "<td>---</td>";
                }
            }
        }
        terminarFilaTiempo();
    }

    //Funcion encargada de recoger los datos de probabilidad de precipitacion,viento,sen. termica y temperatura
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

    //Funcion encargada de imprimir los datos de la probabilidad de precipitacion
    function imprimirDatosTiempoProbPre($datos,$mostrar)
    {
        print "<tr><th>$mostrar</th>";
        foreach($datos as $dato)
        {
            if($dato != null)
                print "<td>".$dato[0] ."</td>";
            else
                print "<td>---</td>";
        }
    }

    //Funcion encargada de imprimir los datos del viento
    function imprimirDatosTiempoViento($datos,$mostrar)
    {
        print "<tr><th>$mostrar</th>";
        foreach($datos as $dato)
        {
            print "<td>".$dato->direccion ."  " . $dato->velocidad . "</td>";
        }
    }

    //Funcion encargada de imprimir los datos de la temperatura
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
                    print "<td>---</td><td>---</td><td>---</td><td>".$dato->minima ."/". $dato->maxima . "</td><td>---</td><td>---</td><td>---</td>";
                }
                else if($indice == 3 || $indice == 4)
                {
                    print "<td>---</td><td>".$dato->minima ."/". $dato->maxima . "</td><td>---</td>";
                }
                else
                {
                    print "<td>".$dato->minima ."/". $dato->maxima . "</td>";
                }
            }
            else
                print "<td>---</td>";
            $indice += 1;
        }
    }

    //Funcion encargada de imprimir los datos de la sensacion termica
    function imprimirDatosTiempoSen($datos,$mostrar)
    {
        print "<tr><th>$mostrar</th>";
        $indice = 1;
        foreach($datos as $dato)
        {
            if($indice == 1 || $indice == 2)
            {
                print "<td>---</td><td>---</td><td>---</td>";
                foreach($dato->dato as $valores)
                    print "<td>". $valores ."</td>";
            }
            else if($indice == 3 || $indice == 4)
            {
                print "<td>---</td><td>". $dato->minima ."/". $dato->maxima ."</td><td>---</td>";
            }
            else
            {
                print "<td>". $dato->minima ."/". $dato->maxima ."</td>";
            }
            $indice += 1;
        }
    }
    
    //Funcion encargada de crear el principio de la tabla del tiempo
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

    //Funcion principal para procesar el censo de los archivos .txt y .csv
    function censo()
    {
        if(file_exists("..\\..\\..\\gestionFicheros\\CensoProvinciaHombresMujeres.txt") && file_exists("..\\..\\..\\gestionFicheros\\CensoProvinciaHombresMujeres.csv"))
        {
            $censo1 = file("..\\..\\..\\gestionFicheros\\CensoProvinciaHombresMujeres.txt");
            $censo2 = file("..\\..\\..\\gestionFicheros\\CensoProvinciaHombresMujeres.csv");
            $censo = "censo";
            for ($i=1; $i <= 2; $i++) { 
                $Censo = ${$censo . $i};
                if($i == 1)
                    print "<h3>ARCHIVO .TXT</h3>";
                else
                    print "<h3>ARCHIVO .CSV</h3>";
                separarLineas($Censo,$i);
                print "<br><br><br>";
            }
        }
        else
            trigger_error("No se encunetran los ficheros para procesar el censo");
    }

    //Funcion para saber que archivo estamos procesando
    function separarLineas(&$Censo,$archivo)
    {
        if($archivo == 1)
            separarLineas1($Censo);//Archivo .txt
        else
            separarLineas2($Censo);//Archivo .csv
    }

    //Funcion para separar las lineas del array creado por la funcion 'file' para imprimir los datos
    function separarLineas1(&$Censo)
    {
        $indice = 1;
        $datos = false;
        $nombreSeparado = false;
        foreach ($Censo as $linea => &$contenido) {
            if($indice == 8)
                $datos = true;
            if($indice == 23 || $indice == 43)
                $nombreSeparado = true;
            if($indice == 6)
                imprimirCabeceraArchivo1Censo($contenido);
            else if($indice > 6)
            {
                imprimirLineasenTablaArchivo1($contenido,$datos,$nombreSeparado);
                $nombreSeparado = false;
            }
            $indice += 1;
        }
        print "</table>";
    }

    //Funcion para separar las lineas del array creado por la funcion 'file' para imprimir los datos
    function separarLineas2(&$Censo)
    {
        cabeceraTablaCensoArchivo2();
        $indice = 0;
        $contenidoCenso = array();
        foreach ($Censo as $linea => &$contenido) {
            if($indice !=0)
            {
                $contenidoCenso[$linea] = $contenido;
                if($indice % 4 == 0)
                {
                    imprimirLineasenTablaArchivo2($contenidoCenso);
                    for ($i=$indice - 4; $i <=$indice ; $i++) { 
                        unset($contenidoCenso[$i]);
                    }
                }
            }
            $indice += 1;
        }
        print "</table>";
    }

    //Funcion para imprimir el comienzo de la tabla del archivo .txt
    function imprimirCabeceraArchivo1Censo(&$linea)
    {
        $contenido = explode(',',$linea);
        print "<table border='1'>";
        print "<tr><th></th><th colspan='2'>". $contenido[1] ."</th><th colspan='2'>". $contenido[3] ."</th></tr>";
    }

    //Funcion encargada de imprimir los datos existentes del archivo .txt
    function imprimirLineasenTablaArchivo1($linea,$datos,$nombreSeparado)
    {
        $contenido = explode(',',$linea);
        print "<tr>";
        if($datos)
        {
            if(!$nombreSeparado)
            {
                for ($i=0; $i < count($contenido) -1; $i++) { 
                    print "<td>". $contenido[$i] ."</td>";
                }
            }
            else
            {
                print "<td>". $contenido[0] ." ". $contenido[1] ."</td>";
                for ($i=2; $i < count($contenido) -1; $i++) { 
                    print "<td>". $contenido[$i] ."</td>";
                }
            }
        }
        else
        {
            for ($i=0; $i < count($contenido) -1; $i++) { 
                if($i == 0)
                    print "<td></td>";
                else
                    print "<th>". $contenido[$i] ."</th>";
            }
        }
        terminarFilaTiempo();
    }

    //Funcion para imprimir el comienzo de la tabla del archivo .csv
    function cabeceraTablaCensoArchivo2()
    {
        print "<table border='1'>";
        print "<tr><th></th><th colspan='2'>2023</th><th colspan='2'>2022</th></tr>";
        print "<tr><th></th><th>Hombre</th><th>Mujer</th><th>Hombre</th><th>Mujer</th></tr>";
    }

    //Funcion encargada de imprimir los datos existentes del archivo .csv
    function imprimirLineasenTablaArchivo2($linea)
    {
        $contenido = array();
        $i = 0;
        foreach ($linea as $key => $cont) {
            $contenido[$i] = explode(';',$cont);
            $i += 1;
        }
        print ("<tr><th>".$contenido[0][0]."</th><td>".$contenido[0][3]."</td><td>".$contenido[2][3]."</td><td>".$contenido[1][3]."</td><td>".$contenido[3][3]."</td></tr>");
    }
?>