<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Facturas</title>
</head>
<body>
    
    <?php
        if(isset($datosFacturas))
        {
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
    ?>

    <form id="" name="" action="" method="post" >
		<input type="submit" name="facturas" value="Consultar Facturas">
    </form>
    <a href="controller_cerrarSession.php">Cerrar Sesion</a>
</body>
</html>