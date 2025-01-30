<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar Salario</title>
 </head>

<body>

    <div class="container ">
        <!--Aplicacion-->
		<div  style="max-width: 30rem;">
		<div >Modificar Salario Empleado</div>
		<div>
		
		<form id="" name="" action="" method="post" >
		
		<div >
			Empleado <select name="empleados" id="empleados" required>
                <?php
                    foreach ($empleados as $empleado => $titulo) {
                        print "<option value='".$titulo["emp_no"]."'>".$titulo["emp_no"]." | ".$titulo["nombre"]."</option>";
                    }
                ?>
            </select>
        </div>
		<div>
			Salario Nuevo <input type="text" name="sal" placeholder="Nuevo Salario" required>
        </div>				
        
		<input type="submit" name="modSal" value="Modificar Salario">
        </form>
		
	    </div>
        <a href="controller_welcome.php">Volver a la Pagina Principal</a>
        <a href="controller_cerrarSession.php">Cerrar Sesion</a>
    </div>
    </div>
    </div>
</body>
</html>