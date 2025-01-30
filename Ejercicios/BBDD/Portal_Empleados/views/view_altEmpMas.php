<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alta Empleado</title>
 </head>

<body>

    <div class="container ">
        <!--Aplicacion-->
		<div  style="max-width: 30rem;">
		<div >Alta Empleados Masivo</div><br>
		<div>
		
		<form id="" name="" action="" method="post" >
		
		<div>
			Nombre <input type="text" name="nombre" placeholder="nombre" >
        </div>
		<div>
			Apellido <input type="text" name="apellido" placeholder="apellido" >
        </div>			
        <div>
			Fecha Nacimiento <input type="text" name="fecNac" placeholder="YYYY-MM-DD" >
        </div>	
        <div>
			Genero <input type="text" name="genero" placeholder="M/F" >
        </div>	
        <div>
			Salario <input type="text" name="sal" placeholder="Salario del Empleado" >
        </div>	
        <div>
			Departamento <select name="departamento" id="departamento" >
            <?php
                foreach ($departamentos as $departamento => $titulo) {
                    print "<option value='".$titulo["dept_no"]."'>".$titulo["dept_name"]."</option>";
                }
            ?>
            </select>
        </div>
        <div>
			Cargo a Desempeñar <select name="cargo" id="cargo" >
            <?php
                foreach ($cargos as $cargo => $titulo) {
                    print "<option value='".$titulo["title"]."'>".$titulo["title"]."</option>";
                }
            ?>
            </select>
        </div>	
        <input type="submit" name="cesta" value="Añadir a la Cesta">
		<input type="submit" name="alta" value="Dar de Alta">
        </form>
		<a href="controller_welcome.php">Volver a la Pagina Principal</a>
        <a href="controller_cerrarSession.php">Cerrar Sesion</a>
	    </div>
    </div>
    </div>
    </div>
</body>
</html>