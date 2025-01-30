<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cambiar Departamento</title>
 </head>

<body>

    <div class="container ">
        <!--Aplicacion-->
		<div  style="max-width: 30rem;">
		<div >Cambiar Departamento Empleado</div>
		<div>

		<form id="" name="" action="" method="post" >
		
		<div >
			Empleado <select name="empleados" id="empleados" required>
                <?php
                    foreach ($empleados as $empleado => $titulo) {
                        print "<option value='".$titulo["emp_no"]."|".$titulo["dept_no"]."'>".$titulo["emp_no"]." | ".$titulo["nombre"]." | ".$titulo["dept_no"]." | ".$titulo["dept_name"]."</option>";
                    }
                ?>
            </select>
        </div>		
        <div >
			Departamento Nuevo <select name="departamentos" id="departamentos" required>
                <?php
                    foreach ($departamentos as $departamento => $titulo) {
                        print "<option value='".$titulo["dept_no"]."'>".$titulo["dept_no"]." | ".$titulo["dept_name"]."</option>";
                    }
                ?>
            </select>
        </div>	
		<input type="submit" name="cambioDept" value="Cambiar Departamento">
        </form>
		
	    </div>
        <a href="controller_welcome.php">Volver a la Pagina Principal</a>
        <a href="controller_cerrarSession.php">Cerrar Sesion</a>
    </div>
    </div>
    </div>
</body>
</html>