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
            if(isset($resultado))
            {
                print "<h1><strong>Empleado $empleado</strong></h1><br>";
                print "<h2><strong>Informacion Personal</strong></h2>";
                print "<table border='1'><tr><th>Numero Empleado</th><th>Fecha Nacimiento</th><th>Nombre</th><th>Apellido</th><th>Sexo</th><th>Fecha Contratacion</th><th>Fecha Baja</th></tr>";
                print "<tr><td>".$resultado[0]["emp_no"]."</td><td>".$resultado[0]["birth_date"]."</td><td>".$resultado[0]["first_name"]."</td><td>".$resultado[0]["last_name"]."</td><td>".$resultado[0]["gender"]."</td><td>".$resultado[0]["hire_date"]."</td><td>$baja</td></tr></table>";
                print "<br>";
                print "<h2><strong>Historico de Salarios</strong></h2>";
                $salarios = $resultado[0]["salaries"];
                if(count(explode(",",$salarios)) > 1)
                {
                    $salariosDivididos = explode(",",$salarios);
                    print "<h4>Salarios Antiguos</h4><ul>";
                    for ($i=0; $i < count($salariosDivididos) - 1; $i++) 
                    { 
                        print "<li>".$salariosDivididos[$i]."€</li>";
                    }
                    print "</ul>";
                    print "<h4>Salario Actual</h4><ul><li>".$salariosDivididos[count($salariosDivididos) - 1]."€</li></ul>";
                }
                else
                {
                    print "<h4>Salario Actual</h4><ul><li>".$salarios."€</li></ul>";
                }
                print "<br>";
                print "<h2><strong>Historico de Titulaciones</strong></h2>";
                $titulos = $resultado[0]["titles"];
                if(count(explode(",",$titulos)) > 1)
                {
                    $titulosDivididos = explode(",",$titulos);
                    print "<h4>Titulaciones Antiguas</h4><ul>";
                    for ($i=0; $i < count($titulosDivididos) - 1; $i++) 
                    { 
                        print "<li>".$titulosDivididos[$i]."</li>";
                    }
                    print "</ul>";
                    print "<h4>Titulacion Actual</h4><ul><li>".$titulosDivididos[count($titulosDivididos) - 1]."</li></ul>";
                }
                else
                {
                    print "<h4>Salario Actual</h4><ul><li>".$titulos."</li></ul>";
                }
                print "<br>";
                print "<h2><strong>Historico de Departamentos</strong></h2>";
                if(count($resultado) >= 1)
                {
                    print "<h4>Departamentos Antiguos</h4><ul>";
                    for ($i=0; $i < count($resultado) - 1; $i++) 
                    { 
                        print "<li>".$resultado[$i]["dept_names"]." | ".$resultado[$i]["dept_no"]."</li>";
                    }
                    print "</ul>";
                    print "<h4>Departamento Actual</h4><ul><li>".$resultado[count($resultado) - 1]["dept_names"]." | ".$resultado[count($resultado) - 1]["dept_no"]."</li></ul>";
                }
                else
                {
                    print "<h4>Departamento Actual</h4><ul><li>".$resultado[0]["dept_names"]." | ".$resultado[0]["dept_no"]."</li></ul>";
                }
                
            }
        ?>

		<form id="" name="" action="" method="post" >	
        
		<input type="submit" name="vidLabEmp" value="Saber Vida Laboral">
        </form>
		
	    </div>
        <a href="controller_welcome.php">Volver a la Pagina Principal</a><br>
        <a href="controller_cerrarSession.php">Cerrar Sesion</a>
    </div>
    </div>
    </div>
</body>
</html>