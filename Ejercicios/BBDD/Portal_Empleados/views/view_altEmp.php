<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alta Empleado</title>
 </head>

<body>
    <h1>MOVILMAD</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div  style="max-width: 30rem;">
		<div >Login Usuario</div>
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
			Departamento <select name="cargo" id="cargo" required>
            <?php
                foreach ($departamentos as $departamento) {
                    print "<option value='".$departamento."'>".$departamento."</option>";
                }
            ?>
            </select>
        </div>	
        <div>
			Cargo a Desempeñar <select name="cargo" id="cargo" required>
            <?php
                foreach ($cargos as $cargo) {
                    print "<option value='".$cargo."'>".$cargo."</option>";
                }
            ?>
            </select>
        </div>	
		<input type="submit" name="submit" value="Login">
        </form>
		
	    </div>
    </div>
    </div>
    </div>
</body>
</html>