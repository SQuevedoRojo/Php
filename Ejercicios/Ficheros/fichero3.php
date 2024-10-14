<HTML>
<H1>Ejercicio 1</H1>
<BODY>
<h1>Datos Alumnos</h1>
    <?php
            function recogerDatos()
            {
                $file = fopen('C:\\wamp64\\www\\files\\alumnos1.txt',"r") or die("No se ha encontrado el fichero");
                print("<table border='1'>");
                print "<tr><th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th><th>Fecha Nacimiento</th><th>Localidad</th></tr>";
                while(!feof($file))
                {
                    $datos = fichero(fgets($file));
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
                $data[0] = limpiar(substr($linea,0,39));
                $data[1] = limpiar(substr($linea,40,39));
                $data[2] = limpiar(substr($linea,81,40));
                $data[3] = limpiar(substr($linea,123,10));
                $data[4] = limpiar(substr($linea,133,26));
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