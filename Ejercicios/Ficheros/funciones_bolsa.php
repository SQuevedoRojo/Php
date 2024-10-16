<?php
    function leerFichero()
    {
        if(file_exists("..\\..\\..\\bolsa\\ibex35.txt"))
        {
            $file = fopen("..\\..\\..\\bolsa\\ibex35.txt","r");
            $contador = 0;
            imprimirCabeceraBolsa();
            while(!feof($file))
            {
                $datos = fgets($file);
                if($contador > 0)
                {
                    $datos = separarCampos($datos);
                    if(count($datos) != 0)
                        imprimirDatos1($datos);
                }
                $contador += 1;
            }
            imprimirFinBolsa();
        }   
        else
            print "<h3>No existe el archivo</h3>";
    }

    function leerFichero2($valor)
    {
        if(file_exists("..\\..\\..\\bolsa\\ibex35.txt"))
        {
            $file = fopen("..\\..\\..\\bolsa\\ibex35.txt","r");
            $contador = 0;
            $encontrado = false;
            
            while(!feof($file))
            {
                $datos = fgets($file);
                if($contador > 0)
                {
                    $datos = separarCampos($datos);
                    if(strtolower($datos[0]) == $valor)
                    {
                        imprimirCabeceraBolsa();
                        imprimirDatos1($datos);
                        imprimirFinBolsa();
                        $encontrado = true;
                    }
                }
                $contador += 1;
            }
            
            if(!$encontrado)
                print "<h3>No se ha encontrado los campos del valor introducido</h3>";
        }       
        else
            print "<h3>No existe el archivo</h3>";
    }

    function leerFichero3($valor)
    {
        if(file_exists("..\\..\\..\\bolsa\\ibex35.txt"))
        {
            $file = fopen("..\\..\\..\\bolsa\\ibex35.txt","r");
            $contador = 0;
            while(!feof($file))
            {
                $datos = fgets($file);
                if($contador > 0)
                {
                    $datos = separarCampos($datos);
                    if($datos[0] == $valor)
                    {
                        imprimirDatos3($datos);
                    }
                }
                $contador += 1;
            }
        }       
        else
            print "<h3>No existe el archivo</h3>";
    }

    function leerFichero4($valor,$mostrar)
    {
        if(file_exists("..\\..\\..\\bolsa\\ibex35.txt"))
        {
            $file = fopen("..\\..\\..\\bolsa\\ibex35.txt","r");
            $contador = 0;
            while(!feof($file))
            {
                $datos = fgets($file);
                if($contador > 0)
                {
                    $datos = separarCampos($datos);
                    if($datos[0] == $valor)
                    {
                        imprimirDatos4($datos,$mostrar);
                    }
                }
                $contador += 1;
            }
        }       
        else
            print "<h3>No existe el archivo</h3>";
    }

    function leerFichero5($mostrar)
    {
        if(file_exists("..\\..\\..\\bolsa\\ibex35.txt"))
        {
            $file = fopen("..\\..\\..\\bolsa\\ibex35.txt","r");
            $contador = 0;
            $total = 0;
            while(!feof($file))
            {
                $datos = fgets($file);
                if($contador > 0)
                {
                    $datos = separarCampos($datos);
                    $total += (float) str_replace(".","",$datos[$mostrar]);
                }
                $contador += 1;
            }
            imprimirDatos5($total,$mostrar);
        }       
        else
            print "<h3>No existe el archivo</h3>";
    }

    function leerFichero6()
    {
        if(file_exists("..\\..\\..\\bolsa\\ibex35.txt"))
        {
            $file = fopen("..\\..\\..\\bolsa\\ibex35.txt","r");
            $contador = 0;
            $totalValores = 0;
            $maximaCot = ["",0];
            $minimaCot = ["",9999999999];
            $maximoVol = ["",0];
            $minimoVol = ["",999999999];
            $maximaCap = ["",0];
            $minimaCap = ["",999999999];
            while(!feof($file))
            {
                $datos = fgets($file);
                if($contador != 0)
                {
                    $datos = separarCampos($datos);
                    $totalValores += (float) str_replace(".","",$datos[1]);
                    saberMaxMin($datos,$maximaCot,$minimaCot,$maximoVol,$minimoVol,$maximaCap,$minimaCap);
                }
                $contador += 1;
            }
            imprimirDatos6($totalValores,$maximaCot,$minimaCot,$maximoVol,$minimoVol,$maximaCap,$minimaCap);
        }       
        else
            print "<h3>No existe el archivo</h3>";
    }

    function separarCampos($linea)
    {
        $datos = array();
        $datos[0] = limpiar(substr($linea,0,23));
        $datos[1] = limpiar(substr($linea,23,9));
        $datos[2] = limpiar(substr($linea,32,8));
        $datos[3] = limpiar(substr($linea,40,8));
        $datos[4] = limpiar(substr($linea,48,12));
        $datos[5] = limpiar(substr($linea,60,9));
        $datos[6] = limpiar(substr($linea,69,9));
        $datos[7] = limpiar(substr($linea,78,13));
        $datos[8] = limpiar(substr($linea,91,9));
        $datos[9] = limpiar(substr($linea,100,5));
        return $datos;
    }

    function limpiar($data)
    {
        $data = trim($data);
        return $data;
    }

    function imprimirCabeceraBolsa()
    {
        print("<table border='1'>");
        print "<tr><th>Valor</th><th>Ultimo</th><th>Var. %</th><th>Var.</th><th>Ac.% año</th><th>Max.</th><th>Min.</th><th>Vol.</th><th>Capit.</th><th>Hora</th></tr>";
    }

    function imprimirFinBolsa()
    {
        print("</table>");
    }

    function imprimirDatos1($datos)
    {
        print "<tr><th>" . $datos[0] ."</th><th>" . $datos[1] ."</th><th>" . $datos[2] ."</th><th>" . $datos[3] ."</th><th>" . $datos[4] ."</th><th>" . $datos[5] ."</th><th>" . $datos[6] ."</th><th>" . $datos[7] ."</th><th>" . $datos[8] ."</th><th>" . $datos[9] ."</th></tr>";
    }

    function imprimirDatos3($datos)
    {
        print "<h4>El valor de <strong>COTIZACION</strong> de ". $datos[0] . " es " . $datos[1] . "</h4>";
        print "<h4><strong>COTIZACION MAXIMA</strong> de ". $datos[0] . " es " . $datos[5] . "</h4>";
        print "<h4><strong>COTIZACION MINIMA</strong> de ". $datos[0] . " es " . $datos[6] . "</h4>";
    }

    function imprimirDatos4($datos,$mostrar)
    {
        print "<h4>". saberCampo4($mostrar) ." de ". $datos[0] . " es " . $datos[$mostrar] . "</h4>";
    }

    function saberCampo4($campo)
    {
        $cadena = "";
        switch ($campo) {
            case 1:
                $cadena = "EL ultimo valor";
                break;   
            case 2:
                $cadena = "La variacion %";
                break;
            case 3:
                $cadena = "La variacion";
                break;
            case 4:
                $cadena = "El ac%Anual";
                break;
            case 5:
                $cadena = "El maximo";
                break;
            case 6:
                $cadena = "El minimo";
                break;
            case 7:
                $cadena = "El volumen";
                break;
            case 8:
                $cadena = "La capitalizacion";
                break;
        }
        return $cadena;
    }

    function imprimirDatos5($total,$mostrar)
    {
        print "<h4>". saberCampos5($mostrar) ." " . $total . "</h4>";
    }

    function saberCampos5($mostrar)
    {
        $cadena = "";
        if($mostrar == 7)
            $cadena = "Total volumen";
        else
            $cadena = "Total capitalizacion";
        return $cadena;
    }

    function imprimirDatos6($totalValores,$maximaCot,$minimaCot,$maximoVol,$minimoVol,$maximaCap,$minimaCap)
    {
        print "<h4>El total de Valores es ". $totalValores ."</h4>";
        print "<h4>El valor de la máxima cotizacion es " . $maximaCot[0] . " con " . $maximaCot[1] . "</h4>";
        print "<h4>El valor de la minima cotizacion es " . $minimaCot[0] . " con " . $minimaCot[1] . "</h4>";
        print "<h4>El valor del máximo volumen es " . $maximoVol[0] . " con " . $maximoVol[1] . "</h4>";
        print "<h4>El valor del minimo volumen es " . $minimoVol[0] . " con " . $minimoVol[1] . "</h4>";
        print "<h4>El valor de la máxima capitalizacion es " . $maximaCap[0] . " con " . $maximaCap[1] . "</h4>";
        print "<h4>El valor de la minima capitalizacion es " . $minimaCap[0] . " con " . $minimaCap[1] . "</h4>";
    }

    function saberMaxMin($datos,&$maximaCot,&$minimaCot,&$maximoVol,&$minimoVol,&$maximaCap,&$minimaCap)
    {
        if($maximaCot[1] < ((float) str_replace(",",".",$datos[1])))
        {
            $maximaCot[0] = $datos[0];
            $maximaCot[1] = ((float) str_replace(",",".",$datos[1]));
        }
        if($minimaCot[1] > ((float) str_replace(",",".",$datos[1])) && $datos[1] != '')
        {
            $minimaCot[0] = $datos[0];
            $minimaCot[1] = ((float) str_replace(",",".",$datos[1]));
        }
        if($maximoVol[1] < ((float) str_replace(".","",$datos[7])))
        {
            $maximoVol[0] = $datos[0];
            $maximoVol[1] = ((float) str_replace(".","",$datos[7]));
        }
        if($minimoVol[1] > ((float) str_replace(".","",$datos[7])) && $datos[7] != '')
        {
            $minimoVol[0] = $datos[0];
            $minimoVol[1] = ((float) str_replace(".","",$datos[7]));
        }
        if($maximaCap[1] < ((float) str_replace(".","",$datos[8])))
        {
            $maximaCap[0] = $datos[0];
            $maximaCap[1] = ((float) str_replace(".","",$datos[8]));
        }
        if($minimaCap[1] > ((float) str_replace(".","",$datos[8])) && $datos[8] != '')
        {
            $minimaCap[0] = $datos[0];
            $minimaCap[1] = ((float) str_replace(".","",$datos[8]));
        }
    }
?>