<HTML>
<H1>Bolsa</H1>
<BODY>
<h1>Bolsa EJ 5</h1>
<form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
    <label for="mostrarTotales">Mostrar : </label>
    <select name="mostrar" id="mostrarTotales" required>
        <option value="7">Total Volumen</option>
        <option value="8">Total Capitalizacion</option>
    </select>
    <br>
    <input type="submit" value="enviar">
    <input type="reset" value="borrar">
</form>
<?php
    function leerFichero($mostrar)
    {
        if(file_exists("..\\..\\..\\bolsa\\ibex35.txt"))
        {
            $file = fopen("..\\..\\..\\bolsa\\ibex35.txt","r");
            $contador = 0;
            $total = 0;
            while(!feof($file))
            {
                $datos = fgets($file);
                if($contador > 0)
                {
                    $datos = separarCampos($datos);
                    $total += $datos[$mostrar];
                }
                $contador += 1;
            }
            imprimirDatos($total,$mostrar);
        }       
        else
            print "<h3>No existe el archivo</h3>";
    }

    function separarCampos($linea)
    {
        $datos = array();
        $datos[0] = limpiar(substr($linea,0,23));
        $datos[1] = limpiar(substr($linea,23,9));
        $datos[2] = limpiar(substr($linea,32,8));
        $datos[3] = limpiar(substr($linea,40,8));
        $datos[4] = limpiar(substr($linea,48,12));
        $datos[5] = limpiar(substr($linea,60,9));
        $datos[6] = limpiar(substr($linea,69,9));
        $datos[7] = limpiar(substr($linea,78,13));
        $datos[8] = limpiar(substr($linea,91,9));
        $datos[9] = limpiar(substr($linea,100,5));
        return $datos;
    }

    function limpiar($data)
    {
        $data = trim($data);
        return $data;
    }

    function imprimirDatos($total,$mostrar)
    {
        print "<h4>". saberCampo($mostrar) ." " . $total . "</h4>";
    }

    function saberCampos($mostrar)
    {
        $cadena = "";
        if($mostrar == 7)
            $cadena = "Total volumen";
        else
            $cadena = "Total capitalizacion";
    }
?>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $mostrar = $_REQUEST['mostrar'];
        leerFichero($mostrar);
    }
?>
</BODY>
</HTML>