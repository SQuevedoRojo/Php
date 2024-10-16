<HTML>
<H1>Bolsa</H1>
<BODY>
<h1>Bolsa EJ 3</h1>
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
    <br>
    <input type="submit" value="enviar">
    <input type="reset" value="borrar">
</form>
<?php
    include 'funciones_bolsa.php';
?>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $valor = $_REQUEST['valor'];
        leerFichero3($valor);
    }
?>
</BODY>
</HTML>