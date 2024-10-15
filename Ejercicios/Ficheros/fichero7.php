<HTML>
<H1>Ejercicio 7</H1>
<BODY>
<h1>Operaciones Ficheros</h1>
    <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
        Fichero Origen (path/nombre) :<input type="text" name="ficheroOrigen" required><br>
        Fichero Destino (path/nombre) :<input type="text" name="ficheroDestino"><br>
        Operaciones
        <input type="radio" name="tipoOperacion" value="copiarFichero"> Copiar Fichero <br>
        <input type="radio" name="tipoOperacion" value="renombrarFichero"> Renombrar Fichero <br>
        <input type="radio" name="tipoOperacion" value="borrarFichero"> Borrar Fichero <br>
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
                    $archivoOrigen = $_REQUEST['ficheroOrigen'];
                    $operacion = $_REQUEST['tipoOperacion'];
                    if($operacion == "copiarFichero")
                    {
                        if(isset($_REQUEST['ficheroDestino']))
                        {
                            $archivoDestino = $_REQUEST['ficheroDestino'];
                            copiarFichero($archivoOrigen, $archivoDestino);
                        }
                        else
                        {
                            print "<h3>Debe especificar una ruta o archivo de destino</h3>";
                        }
                    }
                    else if($operacion == "renombrarFichero")
                    {
                        if(isset($_REQUEST['ficheroDestino']))
                        {
                            $archivoDestino = $_REQUEST['ficheroDestino'];
                            renombrarFichero($archivoOrigen, $archivoDestino);
                        }
                        else
                        {
                            print "<h3>Debe especificar una ruta o archivo de destino</h3>";
                        }
                    }
                    else
                    {
                        borrarFichero($archivoOrigen);
                    }
                }
                else
                    print("Debe seleccionar una opcion");
            }

            function copiarFichero($archivoOrigen, $archivoDestino)
            {
                $rutaArchivoOrigen = comprobarRuta($archivoOrigen);
                if(file_exists($rutaArchivoOrigen))
                {
                    comprobarDirectorio($archivoDestino);
                    if(copy($rutaArchivoOrigen,basename($archivoDestino)))
                        print "<h3>Se ha copiado el archivo con exito</h3>";
                    else
                        print "<h3>No se ha podido copiar el fichero</h3>";
                }
                else
                    print "<h2>No existe el archivo</h2>";
            }

            function renombrarFichero($archivoOrigen, $archivoDestino)
            {
                $rutaArchivoOrigen = comprobarRuta($archivoOrigen);
                if(file_exists($rutaArchivoOrigen))
                {
                    comprobarDirectorio($archivoDestino);
                    if(rename($rutaArchivoOrigen,basename($archivoDestino)))
                        print "<h3>Se ha copiado el archivo con exito</h3>";
                    else
                        print "<h3>No se ha podido renombrar el fichero</h3>";
                }
                else
                    print "<h2>No existe el archivo</h2>";
            }

            function borrarFichero($archivoOrigen)
            {
                $rutaArchivoOrigen = comprobarRuta($archivoOrigen);
                if(file_exists($rutaArchivoOrigen))
                {
                    if(unlink($rutaArchivoOrigen))
                        print "<h3>Se ha eliminado el archivo con exito</h3>";
                    else
                        print "<h3>No se ha podido eliminar el fichero</h3>";
                }
                else
                    print "<h2>No existe el archivo</h2>";
            }

            function comprobarRuta($archivo)
            {
                $rutaFichero = "";
                if (is_string($archivo)) 
                {
                    $partes = explode("\\", $archivo);
                    var_dump($partes) ;
                    if (strtolower($partes[0]) == "c:" || $partes[0] == "/") 
                    {
                        $rutaFichero = realpath($archivo);
                        var_dump($archivo);
                    }
                    else 
                    {
                        $rutaFichero = "C:\\wamp64\\www\\files\\" . $archivo;
                    }
                }
                return $rutaFichero;
            }

            function comprobarDirectorio($archivo)
            {
                if(!file_exists($archivo))
                {
                    print "<h3>El directorio " . dirname($archivo) . " no existe</h3>";
                    mkdir($archivo,0777,false);
                    print "<h3>Se ha creado el directorio " . dirname($archivo) . " </h3>";
                }
            }

            recogerDatos();
        }
    ?>

</BODY>
</HTML>