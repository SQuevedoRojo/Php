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

        <?php
            if(isset($infoPersonal) && isset($salarioNeto) && isset($salarioOriginal) && isset($conceptos) && isset($titulaciones) && isset($departamentos))
            {
                print "<h1><strong>Nomina del Empleado $empleado</strong></h1>";
                print "<h2><strong>Informacion Personal</strong></h2>";
                print "<table border='1'><tr><th>Numero Empleado</th><th>Fecha Nacimiento</th><th>Nombre</th><th>Apellido</th><th>Sexo</th><th>Fecha Contratacion</th></tr>";
                print "<tr><td>".$infoPersonal[0]["emp_no"]."</td><td>".$infoPersonal[0]["birth_date"]."</td><td>".$infoPersonal[0]["first_name"]."</td><td>".$infoPersonal[0]["last_name"]."</td><td>".$infoPersonal[0]["gender"]."</td><td>".$infoPersonal[0]["hire_date"]."</td></tr></table>";
                print "<br>";
                print "<h2><strong>Titulacion Actual</strong></h2>";
                print "<ul><li>".$titulaciones[0]["title"]."</li></ul>";
                print "<br>";
                print "<h2><strong>Departamento Actual</strong></h2>";
                print "<ul><li>".$departamentos[0]["dept_no"]." | ".$departamentos[0]["dept_name"]."</li></ul>";
                print "<br>";
                print "<h2><strong>Nomina Actual</strong></h2>";
                print "<h4>Salario Bruto -> $salarioOriginal € </h4>";
                print "<h4>Conceptos Nomina</h4>";
                print "<ul>";
                for ($i=0; $i < count($conceptos); $i++) { 
                    print "<li>".$conceptos[$i]."</li>";
                }
                print "<h4>Salario Neto -> $salarioNeto €</h4>";

            }
        ?>

		<form id="" name="" action="" method="post" >		
        
		<input type="submit" name="nomina" value="Saber Mi Nomina">
        </form>
		
	    </div>
        <a href="controller_welcome.php">Volver a la Pagina Principal</a>
        <a href="controller_cerrarSession.php">Cerrar Sesion</a>
    </div>
    </div>
    </div>
</body>
</html>