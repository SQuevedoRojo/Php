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
		
        <?php
            if(isset($infoPersonal) && isset($salario) && isset($titulaciones) && isset($departamentos))
            {
                print "<h1><strong>Empleado $empleado</strong></h1><br>";
                print "<h2><strong>Informacion Personal</strong></h2>";
                print "<table border='1'><tr><th>Numero Empleado</th><th>Fecha Nacimiento</th><th>Nombre</th><th>Apellido</th><th>Sexo</th><th>Fecha Contratacion</th><th>Fecha Baja</th></tr>";
                print "<tr><td>".$infoPersonal[0]["emp_no"]."</td><td>".$infoPersonal[0]["birth_date"]."</td><td>".$infoPersonal[0]["first_name"]."</td><td>".$infoPersonal[0]["last_name"]."</td><td>".$infoPersonal[0]["gender"]."</td><td>".$infoPersonal[0]["hire_date"]."</td><td>$baja</td></tr></table>";
                print "<br>";
                print "<h2><strong>Historico del Salario</strong></h2>";
                if(count($salario) > 1)
                {
                    print "<h4>Antiguos Salarios</h4>";
                    print "<ul>";
                    for ($i=0; $i < count($salario) - 1; $i++) { 
                        print "<li>".$salario[$i]["salary"]."</li>";
                    }
                    print "</ul>";
                }
                print "<h4>Salario Actual</h4>";
                print "<ul><li>".$salario[count($salario) - 1]["salary"]."</li></ul>";
                print "<br>";
                print "<h2><strong>Historico de Titulaciones</strong></h2>";
                if(count($titulaciones) > 1)
                {
                    print "<h4>Antiguas Titulaciones</h4>";
                    print "<ul>";
                    for ($i=0; $i < count($titulaciones) - 1; $i++) { 
                        print "<li>".$titulaciones[$i]["title"]."</li>";
                    }
                    print "</ul>";
                }
                print "<h4>Titulacion Actual</h4>";
                print "<ul><li>".$titulaciones[count($titulaciones) - 1]["title"]."</li></ul>";
                print "<br>";
                print "<h2><strong>Historico de Departamentos</strong></h2>";
                if(count($departamentos) > 1)
                {
                    print "<h4>Antiguos Departamentos</h4>";
                    print "<ul>";
                    for ($i=0; $i < count($departamentos) - 1; $i++) { 
                        print "<li>".$departamentos[$i]["dept_name"]." | ".$departamentos[$i]["dept_no"]."</li>";
                    }
                    print "</ul>";
                }
                print "<h4>Titulacion Actual</h4>";
                print "<ul><li>".$departamentos[count($departamentos) - 1]["dept_name"]." | ".$departamentos[count($departamentos) - 1]["dept_no"]."</li></ul>";
                print "<br>";
            }
        ?>

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
        
		<input type="submit" name="modSal" value="Saber Vida Laboral">
        </form>
		
	    </div>
        <a href="controller_welcome.php">Volver a la Pagina Principal</a><br>
        <a href="controller_cerrarSession.php">Cerrar Sesion</a>
    </div>
    </div>
    </div>
</body>
</html>