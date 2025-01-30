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
		<div >Alta Empleado</div><br>
		<div>
		
		<form id="" name="" action="" method="post" >
		
		<div>
			Nombre <input type="text" name="nombre" placeholder="nombre" required>
        </div>
		<div>
			Apellido <input type="text" name="apellido" placeholder="apellido" required>
        </div>			
        <div>
			Fecha Nacimiento <input type="text" name="fecNac" placeholder="YYYY-MM-DD" required>
        </div>	
        <div>
			Genero <input type="text" name="genero" placeholder="M/F" required>
        </div>	
        <div>
			Salario <input type="text" name="sal" placeholder="Salario del Empleado" required>
        </div>	
        <div>
			Departamento <select name="departamento" id="departamento" required>
            <?php
                foreach ($departamentos as $departamento => $titulo) {
                    print "<option value='".$titulo["dept_no"]."'>".$titulo["dept_name"]."</option>";
                }
            ?>
            </select>
        </div>
        <div>
			Cargo a Desempeñar <select name="cargo" id="cargo" required>
            <?php
                foreach ($cargos as $cargo => $titulo) {
                    print "<option value='".$titulo["title"]."'>".$titulo["title"]."</option>";
                }
            ?>
            </select>
        </div>	
		<input type="submit" name="submit" value="Dar de Alta">
        </form>
		<a href="controller_welcome.php">Volver a la Pagina Principal</a>
        <a href="controller_cerrarSession.php">Cerrar Sesion</a>
	    </div>
    </div>
    </div>
    </div>
</body>
</html>