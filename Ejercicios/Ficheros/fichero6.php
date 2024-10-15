<HTML>
<H1>Ejercicio 5</H1>
<BODY>
<h1>Operaciones Ficheros</h1>
    <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
        Fichero (path/nombre) :<input type="text" name="fichero" required><br>
        <input type="submit" value="enviar">
        <input type="reset" value="borrar">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            function recogerDatos()
            {
                if(isset($_REQUEST['fichero']))
                {
                    $archivo = $_REQUEST['fichero'];
                    saberDatosFichero($archivo);
                }
                else
                    print("Debe seleccionar una opcion");
            }

            function saberDatosFichero($archivo)
            {
                $rutaArchivo = comprobarRuta($archivo);
                $file = fopen($rutaArchivo,"r") or die ("No se encuentra el archivo");
                print "<h3>Nombre del Fichero</h3> ". basename($rutaArchivo);
                print "<h3>Directorio</h3> " . dirname($rutaArchivo);
                print "<h3>Tamaño del fichero</h3> " . filesize($rutaArchivo) . " Kb";
                print "<h3>Ultima modificación</h3> " . filemtime($rutaArchivo);
                fclose($file);
            }


            function comprobarRuta($archivo)
            {
                $rutaFichero = "";
                if(strtolower($archivo[0]) == "c" || $archivo[0] == "/")
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