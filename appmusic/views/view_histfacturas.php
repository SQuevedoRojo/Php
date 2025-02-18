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
            print "<table border='1'><tr><th>Customer ID</th><th>Invoice ID</th><th>Invoice Line ID</th><th>Invoice Date</th><th>Track ID</th><th>Unit Price</th><th>Quantity</th><th>Total</th></tr>";
            foreach ($datosFacturas as $datos)
            {
                print "<tr><th>".$datos["CustomerId"]."</th><td>".$datos["InvoiceId"]."</td><td>".$datos["InvoiceLineId"]."</td><td>".$datos["InvoiceDate"]."</td><td>".$datos["TrackId"]."</td><td>".$datos["UnitPrice"]."</td><th>".$datos["Quantity"]."</td><td>".$datos["Total"]."</td></tr>";
            }
            print "</table>";
        }
    ?>

    <form id="" name="" action="" method="post" >
		<input type="submit" name="facturas" value="Consultar Facturas">
    </form>
    <a href="controller_cerrarSession.php">Cerrar Sesion</a>
</body>
</html>