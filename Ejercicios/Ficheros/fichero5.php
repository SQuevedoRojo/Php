<HTML>
<H1>Ejercicio 5</H1>
<BODY>
<h1>Operaciones Ficheros</h1>
    <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
        Fichero (path/nombre) :<input type="text" name="fichero" required><br>
        Operaciones <br>
        <input type="radio" name="tipoOperacion" value="mostrarFichero"> Mostrar Fichero <br>
        <input type="radio" name="tipoOperacion" value="mostrarLineaFichero"> Mostrar Linea <input type="number" name="lineaEspecifica"> Fichero <br>
        <input type="radio" name="tipoOperacion" value="mostrarLineasFichero"> Mostrar <input type="number" name="lineasEspecifica"> primeras lineas <br>
        <input type="submit" value="enviar">
        <input type="reset" value="borrar">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            function recogerDatos()
            {
                if(isset($_REQUEST['tipoOperacion']))
                {
                    $operacion = $_REQUEST['tipoOperacion'];
                    $archivo = $_REQUEST['fichero'];
                    if($operacion == "mostrarFichero")
                        mostrarFichero($archivo);
                    else if($operacion == "mostrarLineaFichero")
                        mostrarLineaFichero($archivo);
                    else if($operacion == "mostrarLineasFichero")
                        mostrarLineasFichero($archivo);
                }
                else
                    print("Debe seleccionar una opcion");
            }

            function mostrarFichero($archivo)
            {
                $rutaArchivo = comprobarRuta($archivo);
                if(file_exists($rutaArchivo))
                {
                    $file = fopen($rutaArchivo,"r") or die ("No se encuentra el archivo");
                    while(!feof($file))
                    {
                        print fgets($file);
                        print "<br>";
                    }
                    fclose($file);
                }
                else
                    print "<h2>No existe el archivo</h2>";
            }

            function mostrarLineaFichero($archivo)
            {
                $rutaArchivo = comprobarRuta($archivo);
                $lineaEspecifica = $_REQUEST['lineaEspecifica'];
                if(file_exists($rutaArchivo))
                {
                    $file = fopen($rutaArchivo,"r") or die ("No se encuentra el archivo");
                    $linea = 1;
                    $encontrado = false;
                    while(!feof($file) && !$encontrado)
                    {
                        if($lineaEspecifica == $linea)
                        {
                            print fgets($file);
                            print "<br>";
                            $encontrado = true;
                        }
                        $linea += 1;
                    }
                    fclose($file);
                }
                else
                    print "<h2>No existe el archivo</h2>";
            }

            function mostrarLineasFichero($archivo)
            {
                $rutaArchivo = comprobarRuta($archivo);
                $lineasEspecifica = $_REQUEST['lineasEspecifica'];
                if(file_exists($rutaArchivo))
                {
                    $file = fopen($rutaArchivo,"r") or die ("No se encuentra el archivo");
                    $linea = 1;
                    $encontrado = true;
                    while(!feof($file) && $encontrado)
                    {
                        if($linea <= $lineasEspecifica)
                        {
                            print fgets($file);
                            print "<br>";
                        }
                        else
                            $encontrado = false;
                        $linea += 1;
                    }
                    fclose($file);
                }
                else
                    print "<h2>No existe el archivo</h2>";
            }

            function comprobarRuta($archivo)
            {
                $rutaFichero = "";
                if(strtolower($archivo[0].$archivo[1]) == "c:" || $archivo[0] == "/")
                {
                    $rutaFichero = realpath($archivo);
                }
                else
                    $rutaFichero = "C:\\wamp64\\www\\files\\".$archivo;
                return $rutaFichero;
            }

            recogerDatos();
        }
    ?>

</BODY>
</HTML>