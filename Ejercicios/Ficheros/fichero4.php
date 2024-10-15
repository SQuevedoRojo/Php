<HTML>
<H1>Ejercicio 1</H1>
<BODY>
<h1>Datos Alumnos</h1>
    <?php
            function recogerDatos()
            {
                $file = fopen('..\\..\\..\\files\\alumnos2.txt',"r") or die("No se ha encontrado el fichero");
                imprimirCabecera();
                while(!feof($file))
                {
                    $datos = fichero(fgets($file));
                    if(count($datos) != 0)
                        imprimir($datos);
                }
                fclose($file);
                imprimirFin();
            }
            
            function limpiar($data)
            {
                $data = trim($data);
                return $data;
            }

            function imprimir($datos)
            {
                print "<tr><th>" . $datos[0] ."</th><th>" . $datos[1] ."</th><th>" . $datos[2] ."</th><th>" . $datos[3] ."</th><th>" . $datos[4] ."</th></tr>";
            }

            function imprimirCabecera()
            {
                print("<table border='1'>");
                print "<tr><th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th><th>Fecha Nacimiento</th><th>Localidad</th></tr>";
            }
            function imprimirFin()
            {
                print("</table>");
            }

            recogerDatos();
    ?>

</BODY>
</HTML>