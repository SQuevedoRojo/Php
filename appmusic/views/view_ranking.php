<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Musica Mas Descargada</title>
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
        if(isset($datosMusica))
        {
            if($datosMusica == null)
                print "<h2><strong>No hay Datos en las Fechas Seleccionadas</strong></h2>";
            else
            {
                print "<h2><strong>Musica Mas Descragada Entre las Fechas $fechaInicio -- $fechaFinal</strong></h2>";
                print "<table border='1'><tr><th>Track ID</th><th>Track Name</th><th>Track Composer</th><th>Artist Name</th><th>Album Title</th><th>MediaType</th><th>Genre</th><th>Quantity</th></tr>";
                foreach ($datosMusica as $datos)
                {
                    print "<tr><td>".$datos["TrackId"]."</td><td>".$datos["TName"]."</td><td>".$datos["TComposer"]."</td><td>".$datos["ArName"]."</td><td>".$datos["ATitle"]."</td><td>".$datos["MName"]."</td><td>".$datos["GName"]."</td><th>".$datos["Quantity"]."</th></tr>";
                }
                print "</table>";
            }
        }
    ?>
</body>
</html>