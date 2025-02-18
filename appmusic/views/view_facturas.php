<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Facturas</title>
</head>
<body>
    <form id="" name="" action="" method="post" >
        Fecha Desde: <input type='date' name='fechadesde' value='' size=10 placeholder="fechadesde" required>
        Fecha Hasta: <input type='date' name='fechahasta' value='' size=10 placeholder="fechahasta" required><br><br>
		<input type="submit" name="facturas" value="Consultar Facturas">
    </form>
    <a href="controller_welcome.php">Volver a la Pagina Principal</a><br>
    <a href="controller_cerrarSession.php">Cerrar Sesion</a>
    <?php
        if(isset($datosFacturas))
        {
            if($datosFacturas == null)
                print "<h2><strong>No hay Facturas en las Fechas Seleccionadas</strong></h2>";
            else
            {
                print "<h2><strong>Facturas Entre las Fechas $fechaInicio -- $fechaFinal</strong></h2>";
                $invoiceID = $datosFacturas[0]["InvoiceId"];
                $mostrarCabecera = true; 
                foreach ($datosFacturas as $datos)
                {
                    $invId = $datos["InvoiceId"];
                    if($invId != $invoiceID)
                    {
                        print "\t</table><br>";
                        $mostrarCabecera = true;
                        $invoiceID = $invId;
                    }
                    if($mostrarCabecera)
                    {
                        print "<h2><strong>Cliente : ".$datos["CustomerId"]." | Invoice ID : $invoiceID</strong></h2>";
                        print "\t<table border='1'><tr><th>Invoice Line ID</th><th>Invoice Date</th><th>Track ID</th><th>Unit Price</th><th>Quantity</th><th>Total</th></tr>";
                        $mostrarCabecera = false;
                    }
                    print "\t<tr><td>".$datos["InvoiceLineId"]."</td><td>".$datos["InvoiceDate"]."</td><td>".$datos["TrackId"]."</td><td>".$datos["UnitPrice"]."</td><th>".$datos["Quantity"]."</td><td>".$datos["Total"]."</td></tr>";
                }
            }
        }
    ?>
</body>
</html>