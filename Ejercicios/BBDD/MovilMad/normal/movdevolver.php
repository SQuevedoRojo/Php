﻿<?php include_once "funciones_session.php";include_once "funciones_bbddVehiculos.php";
        iniciarSession();
        if(!verificarSessionExistente())
        {
            eliminarSession();
        }
		var_dump($_SESSION);
?>
<html>
   
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
  </head>
   
  <body>
    <h1>Servicio de ALQUILER DE E-CARS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - DEVOLUCIÓN VEHÍCULO </div>
		<div class="card-body">
	  
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Bienvenido/a:</B><?php print devolverNombre(); ?>  <BR><BR>
		<B>Identificador Cliente:</B><?php print devolverId(); ?>  <BR><BR>
		
			<B>Matricula/Marca/Modelo: </B><select name="vehiculos" class="form-control">
				<?php imprimirVehiculosAlquilados() ?>
			</select>
		<BR><BR>
		<div>
			<input type="submit" value="Devolver Vehiculo" name="devolver" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
	<a href = "cerrarSession.php">Cerrar Sesion</a>
	<?php include_once "funciones_movdevolver.php"; ?>
  </body>
   
</html>



