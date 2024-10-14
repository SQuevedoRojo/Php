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
                    $data[0] = limpiar(substr($linea,0,strpos($linea,"##")));
                    $indice = strpos($linea,"##")+2;
                    $data[1] = limpiar(substr($linea,$indice,strpos($linea,"##",$indice)));
                    $indice = strpos($linea,"##")+2;
                    $data[2] = limpiar(substr($linea,80,strpos($linea,"##",$indice)));
                    $indice = strpos($linea,"##")+2;
                    $data[3] = limpiar(substr($linea,123,strpos($linea,"##",$indice)));
                    $indice = strpos($linea,"##")+2;
                    $data[4] = limpiar(substr($linea,132,strpos($linea,"##",$indice)));
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