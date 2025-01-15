<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="../views/css/bootstrap.min.css">
  </head>
   
 <body>
    <h1>Servicio de ALQUILER DE E-CARS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - CONSULTA ALQUILERES </div>
		<div class="card-body">
	  
	  	
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
				
		<B>Bienvenido/a:</B><?php print $nombre; ?>   <BR><BR>
		<B>Identificador Cliente:</B><?php print $id; ?> <BR><BR>
		     
			 Fecha Desde: <input type='date' name='fechadesde' value='' size=10 placeholder="fechadesde" class="form-control">
			 Fecha Hasta: <input type='date' name='fechahasta' value='' size=10 placeholder="fechahasta" class="form-control"><br><br>
				
		<div>
			<input type="submit" value="Consultar" name="consultar" class="btn btn-warning disabled">
		
			<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">
		
		</div>		
	</form>
    <?php
        if(isset($resultado))
        {
            if($resultado == null)
                print "<h2>No Ha Tenido Alquilado Ningun Vehiculo En Ese Periodo</h2>";
            else
            {
                print "<table border='1'>";
                print "<tr><th>Matricula</th><th>Marca</th><th>Modelo</th><th>Fecha Devolucion</th><th>Precio Total</th></tr>";
                foreach ($resultado as $coche) {
                    print "<tr><td>".$coche["matricula"]."</td><td>".$coche["marca"]."</td><td>".$coche["modelo"]."</td><td>".$coche["fecha_devolucion"]."</td><td>".$coche["preciototal"]."€</td></tr>";
                }
                print "</table>";
            }
        }
    ?>
	<!-- FIN DEL FORMULARIO -->
    <a href = "controllers/controller_cerrarSession.php">Cerrar Sesion</a>

  </body>
   
</html>
