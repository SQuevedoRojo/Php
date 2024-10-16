<HTML>
<H1>Bolsa</H1>
<BODY>
<h1>Bolsa EJ 4</h1>
<form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
    <label for="valores">Valores : </label><select name="valor" id="valores" required>
        <option value="ACCIONA">ACCIONA</option>
        <option value="ACERINOX">ACERINOX</option>
        <option value="ACS">ACS</option>
        <option value="AENA">AENA</option>
        <option value="AMADEUS IT GROUP">AMADEUS IT GROUP</option>
        <option value="ARCELORMITTAL">ARCELORMITTAL</option>
        <option value="BANCO SABADELL">BANCO SABADELL</option>
        <option value="BANKIA">BANKIA</option>
        <option value="BANKINTER">BANKINTER</option>
        <option value="BBVA">BBVA</option>
        <option value="CAIXABANK">CAIXABANK</option>
        <option value="CELLNEX TELECOM">CELLNEX TELECOM</option>
        <option value="CIE. AUTOMOTIVE">CIE. AUTOMOTIVE</option>
        <option value="COLONIAL">COLONIAL</option>
        <option value="DIA">DIA</option>
        <option value="ENAGAS">ENAGAS</option>
        <option value="ENDESA">ENDESA</option>
        <option value="FERROVIAL">FERROVIAL</option>
        <option value="GRIFOLS">GRIFOLS</option>
        <option value="IAG">IAG</option>
        <option value="IBERDROLA">IBERDROLA</option>
        <option value="INDITEX">INDITEX</option>
        <option value="INDRA">INDRA</option>
        <option value="MAPFRE">MAPFRE</option>
        <option value="MEDIASET">MEDIASET</option>
        <option value="MELIA HOTELS">MELIA HOTELS</option>
        <option value="MERLIN PROP.">MERLIN PROP.</option>
        <option value="NATURGY">NATURGY</option>
        <option value="RED ELECTRICA">RED ELECTRICA</option>
        <option value="REPSOL">REPSOL</option>
        <option value="SANTANDER">SANTANDER</option>
        <option value="SIEMENS GAMESA">SIEMENS GAMESA</option>
        <option value="TECNICAS REUNIDAS">TECNICAS REUNIDAS</option>
        <option value="TELEFONICA">TELEFONICA</option>
        <option value="VISCOFAN">VISCOFAN</option>
    </select>
    <label for="mostrarVal">Mostrar : </label>
    <select name="mostrar" id="mostrarVal" required>
        <option value="1">Ultimo Valor</option>
        <option value="2">Variacion %</option>
        <option value="3">Variacion</option>
        <option value="4">Ac%Anual</option>
        <option value="5">Maximo</option>
        <option value="6">Minimo</option>
        <option value="7">Volumen</option>
        <option value="8">Capitalizacion</option>
    </select>
    <br>
    <input type="submit" value="enviar">
    <input type="reset" value="borrar">
</form>
<?php
    function leerFichero($valor,$mostrar)
    {
        if(file_exists("..\\..\\..\\bolsa\\ibex35.txt"))
        {
            $file = fopen("..\\..\\..\\bolsa\\ibex35.txt","r");
            $contador = 0;
            while(!feof($file))
            {
                $datos = fgets($file);
                if($contador > 0)
                {
                    $datos = separarCampos($datos);
                    if($datos[0] == $valor)
                    {
                        imprimirDatos($datos,$mostrar);
                    }
                }
                $contador += 1;
            }
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

    function imprimirDatos($datos,$mostrar)
    {
        print "<h4>". saberCampo($mostrar) ." de ". $datos[0] . " es " . $datos[$mostrar] . "</h4>";
    }

    function saberCampo($campo)
    {
        $cadena = "";
        switch ($campo) {
            case 1:
                $cadena = "EL ultimo valor";
                break;   
            case 2:
                $cadena = "La variacion %";
                break;
            case 3:
                $cadena = "La variacion";
                break;
            case 4:
                $cadena = "El ac%Anual";
                break;
            case 5:
                $cadena = "El maximo";
                break;
            case 6:
                $cadena = "El minimo";
                break;
            case 7:
                $cadena = "El volumen";
                break;
            case 8:
                $cadena = "La capitalizacion";
                break;
        }
        return $cadena;
    }
?>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $valor = $_REQUEST['valor'];
        $mostrar = $_REQUEST['mostrar'];
        leerFichero($valor,$mostrar);
    }
?>
</BODY>
</HTML>