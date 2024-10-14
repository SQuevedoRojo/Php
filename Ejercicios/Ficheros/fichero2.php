<HTML>
<H1>Ejercicio 2</H1>
<BODY>
<h1>Datos Alumnos</h1>
    <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
        Nombre :<input type="text" name="nombre" required><br>
        Apellido 1 :<input type="text" name="ape1" ><br>
        Apellido 2 :<input type="text" name="ape2" ><br>
        Fecha Nacimiento :<input type="text" name="fecNac" required placeholder="dia/mes/año"><br>
        Localidad :<input type="text" name="localidad" required>
        <br>
        <input type="submit" value="enviar">
        <input type="reset" value="borrar">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            function recogerDatos()
            {
                $nombre = limpiar($_REQUEST['nombre']);
                $apellido1 = limpiar($_REQUEST['ape1']);
                $apellido2 = limpiar($_REQUEST['ape2']);
                $fecNac = $_REQUEST['fecNac'];
                $localidad =limpiar($_REQUEST['localidad']);
                fichero($nombre,$apellido1,$apellido2,$fecNac,$localidad);
            }
            
            function limpiar($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            function fichero($nombre,$apellido1,$apellido2,$fecNac,$localidad)
            {
                $file = fopen('C:\\wamp64\\www\\files\\alumnos2.txt',"a") or die("No se ha encontrado el fichero");
                escribirFichero($file,$nombre);
                escribirFichero($file,$apellido1);
                escribirFichero($file,$apellido2);
                escribirFichero($file,$fecNac);
                escribirFichero($file,$localidad); 
                fwrite($file,"\n");
                fclose($file);
            }

            function escribirFichero($file,$campo)
            {
                fwrite($file,$campo);
                fwrite($file,"##");
            }

            recogerDatos();
        }
    ?>

</BODY>
</HTML>