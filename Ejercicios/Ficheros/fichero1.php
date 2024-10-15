<HTML>
<H1>Ejercicio 1</H1>
<BODY>
<h1>Datos Alumnos</h1>
<form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
    Nombre :<input type="text" name="nombre" required><br>
    Apellido 1:<input type="text" name="ape1" ><br>
    Apellido 2:<input type="text" name="ape2" ><br>
    Fecha Nacimiento :<input type="text" name="fecNac" required placeholder="dia/mes/año"><br>
    Localidad :<input type="text" name="localidad" required>
    <br>
    <input type="submit" value="enviar">
    <input type="reset" value="borrar">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    recogerDatos();
}

function recogerDatos(){
    $nombre = limpiar($_REQUEST['nombre']);
    $apellido1 = limpiar($_REQUEST['ape1']);
    $apellido2 = limpiar($_REQUEST['ape2']);
    $fecNac = $_REQUEST['fecNac'];
    $localidad =limpiar($_REQUEST['localidad']);
    fichero($nombre,$apellido1,$apellido2,$fecNac,$localidad);
}

function limpiar($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function fichero($nombre,$ape1,$ape2,$fecNac,$localidad){
    $file = fopen('..\\files\\alumnos1.txt',"a") or die("No se ha encontrado el fichero");
    $indice = 0;
    $indice += strlen($nombre);
    $indice = escribirFichero($file,$nombre,$indice,39);
    $indice += strlen($ape1);
    $indice = escribirFichero($file,$ape1,$indice,80);
    $indice += strlen($ape2);
    $indice = escribirFichero($file,$ape2,$indice,122);
    $indice += strlen($fecNac);
    $indice = escribirFichero($file,$fecNac,$indice,132);
    $indice += strlen($localidad);
    $indice = escribirFichero($file,$localidad,$indice,159);
    fwrite($file,"\n");
    fclose($file);

}

function escribirFichero($file,$campo,$indice,$limite)
{
    fwrite($file,$campo);
    while($indice < $limite)
    {
        fwrite($file," ");
        $indice += 1;
    }
    return $indice;
}
?>

</BODY>
</HTML>