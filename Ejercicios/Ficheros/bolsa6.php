<HTML>
<H1>Bolsa</H1>
<BODY>
<h1>Bolsa EJ 6</h1>
<?php
    function leerFichero()
    {
        if(file_exists("..\\..\\..\\bolsa\\ibex35.txt"))
        {
            $file = fopen("..\\..\\..\\bolsa\\ibex35.txt","r");
            $contador = 0;
            $totalValores = 0;
            $maximaCot = ["",0];
            $minimaCot = ["",9999999999];
            $maximoVol = ["","0"];
            $minimoVol = ["","9999999999"];
            $maximaCap = ["","0"];
            $minimaCap = ["","9999999999"];
            while(!feof($file))
            {
                $datos = fgets($file);
                if($contador > 0)
                {
                    $datos = separarCampos($datos);
                    $totalValores += (float) str_replace(".","",$datos[1]);
                    saberMaxMin($datos,$maximaCot,$minimaCot,$maximoVol,$minimoVol,$maximaCap,$minimaCap);
                }
                $contador += 1;
            }
            imprimirDatos($totalValores,$maximaCot,$minimaCot,$maximoVol,$minimoVol,$maximaCap,$minimaCap);
        }       
        else
            print "<h3>No existe el archivo</h3>";
    }

    function saberMaxMin($datos,&$maximaCot,&$minimaCot,&$maximoVol,&$minimoVol,&$maximaCap,&$minimaCap)
    {
        if($maximaCot[1] < ((float) str_replace(",",".",$datos[1])))
        {
            $maximaCot[0] = $datos[0];
            $maximaCot[1] = $datos[1];
        }
        if($minimaCot[1] > ((float) str_replace(",",".",$datos[1])))
        {
            $minimaCot[0] = $datos[0];
            $minimaCot[1] = $datos[1];
        }
        if(((float) str_replace(".","",$maximoVol[1])) < ((float) str_replace(".","",$datos[7])))
        {
            $maximoVol[0] = $datos[0];
            $maximoVol[1] = $datos[7];
        }
        if(((float) str_replace(".","",$minimoVol[1])) > ((float) str_replace(".","",$datos[7])))
        {
            $minimoVol[0] = $datos[0];
            $minimoVol[1] = $datos[7];
        }
        if(((float) str_replace(".","",$maximaCap[1])) < ((float) str_replace(".","",$datos[8])))
        {
            $maximaCap[0] = $datos[0];
            $maximaCap[1] = $datos[8];
        }
        if(((float) str_replace(".","",$minimaCap[1])) > ((float) str_replace(".","",$datos[8])))
        {
            $minimaCap[0] = $datos[0];
            $minimaCap[1] = $datos[8];
        }
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

    function imprimirDatos($totalValores,$maximaCot,$minimaCot,$maximoVol,$minimoVol,$maximaCap,$minimaCap)
    {
        print "<h4>El total de Valores es ". $totalValores ."</h4>";
        print "<h4>El valor de la máxima cotizacion es " . $maximaCot[0] . " con " . $maximaCot[1] . "</h4>";
        print "<h4>El valor de la minima cotizacion es " . $minimaCot[0] . " con " . $minimaCot[1] . "</h4>";
        print "<h4>El valor del máximo volumen es " . $maximoVol[0] . " con " . $maximoVol[1] . "</h4>";
        print "<h4>El valor del minimo volumen es " . $minimoVol[0] . " con " . $minimoVol[1] . "</h4>";
        print "<h4>El valor de la máxima capitalizacion es " . $maximaCap[0] . " con " . $maximaCap[1] . "</h4>";
        print "<h4>El valor de la minima capitalizacion es " . $minimaCap[0] . " con " . $minimaCap[1] . "</h4>";
    }

?>
<?php

    leerFichero();
?>
</BODY>
</HTML>