<HTML>
<H1>Ejercicio 1</H1>
<BODY>
<h1>Datos Alumnos</h1>
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
                        imprimirDatos($datos);
                }
                $contador += 1;
            }
            imprimirFinBolsa();
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

    function imprimirDatos($datos)
    {
        print "<tr><th>" . $datos[0] ."</th><th>" . $datos[1] ."</th><th>" . $datos[2] ."</th><th>" . $datos[3] ."</th><th>" . $datos[4] ."</th><th>" . $datos[5] ."</th><th>" . $datos[6] ."</th><th>" . $datos[7] ."</th><th>" . $datos[8] ."</th><th>" . $datos[9] ."</th></tr>";
    }
?>
<?php
    leerFichero();
?>
</BODY>
</HTML>