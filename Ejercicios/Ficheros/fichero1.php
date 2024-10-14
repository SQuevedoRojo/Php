<HTML>
<H1>Ejercicio 1</H1>
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
                $file = fopen('C:\\wamp64\\www\\files\\fichero1.txt',"w") or die("No se ha encontrado el fichero");
                $indice = 0;
                $indice += strlen($nombre);
                escribirFichero($file,$nombre,$indice,40);
                $indice += strlen($apellido1);
                escribirFichero($file,$apellido1,$indice,81);
                $indice += strlen($apellido2);
                escribirFichero($file,$apellido2,$indice,123);
                $indice += strlen($fecNac);
                escribirFichero($file,$fecNac,$indice,133);
                $indice += strlen($localidad);
                escribirFichero($file,$localidad,$indice,160); 

            }

            function escribirFichero($file,$campo,$indice,$limite)
            {
                fwrite($file,$campo);
                while($indice < $limite)
                {
                    fwrite($file," ");
                    $indice += 1;
                }
            }

            recogerDatos();
        }
    ?>

</BODY>
</HTML>