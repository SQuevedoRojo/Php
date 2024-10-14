<HTML>
<H1>Ejercicio 1</H1>
<BODY>
<h1>Datos Alumnos</h1>
    <?php
            function recogerDatos()
            {
                $file = fopen('C:\\wamp64\\www\\files\\alumnos2.txt',"r") or die("No se ha encontrado el fichero");
                print("<table border='1'>");
                print "<tr><th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th><th>Fecha Nacimiento</th><th>Localidad</th></tr>";
                while(!feof($file))
                {
                    $datos = fichero(fgets($file));
                    if(count($datos) != 0)
                        imprimir($datos);
                }
                fclose($file);
                print("</table>");
            }
            
            function limpiar($data)
            {
                $data = trim($data);
                return $data;
            }

            function fichero($linea)
            {
                $data = array();
                if($linea != ""){
                    $indice = 0;
                    $data[0] = limpiar(substr($linea,0,strpos($linea,"##")));
                    $indice += strpos($linea,"##",$indice);
                    $data[1] = limpiar(substr($linea,$indice+2,strpos($linea,"##",$indice+1)));
                    $indice += strpos($linea,"##",$indice);
                    $data[2] = limpiar(substr($linea,$indice+2,strpos($linea,"##",$indice+1)));
                    $indice += strpos($linea,"##",$indice);
                    $data[3] = limpiar(substr($linea,$indice+2,strpos($linea,"##",$indice+1)));
                    $indice += strpos($linea,"##",$indice);
                    $data[4] = limpiar(substr($linea,$indice,strpos($linea,"##",-1)));
                    var_dump($data);
                }
                return $data;
            }

            function imprimir($datos)
            {
                print "<tr><th>" . $datos[0] ."</th><th>" . $datos[1] ."</th><th>" . $datos[2] ."</th><th>" . $datos[3] ."</th><th>" . $datos[4] ."</th></tr>";
            }

            recogerDatos();
    ?>

</BODY>
</HTML>