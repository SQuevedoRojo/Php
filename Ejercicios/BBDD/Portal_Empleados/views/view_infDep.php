<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informacion Departamentos</title>
 </head>

<body>

    <div class="container ">
        <!--Aplicacion-->
		<div  style="max-width: 30rem;">
		<div >Informacion de Departamentos</div>
		<div>

        <?php
            if(isset($jefe) && isset($empleadosTrabajando) && isset($empleadosCambiados))
            {
                print "<h1><strong>Informacion del Departamento $departamento</strong></h1>";
                print "<h2><strong>Jefe del departamento</strong></h2>";
                if(count($jefe) > 1)
                {
                    print "<h4>Antiguos Jefes</h4>";
                    print "<ul>";
                    for ($i=0; $i < count($jefe) - 1; $i++) { 
                        print "<li>".$jefe[$i]["emp_no"]." | ".$jefe[$i]["nombre"]."</li>";
                    }
                    print "</ul>";
                }
                print "<h4>Jefe Actual</h4>";
                print "<ul><li>".$jefe[count($jefe) - 1]["emp_no"]." | ".$jefe[count($jefe) - 1]["nombre"]."</li></ul>";
                print "<br>";
                print "<h2><strong>Empleados Trabajando en el Departamento</strong></h2>";
                if(count($empleadosCambiados) > 1)
                {
                    print "<h4>Antiguos Empleados</h4>";
                    print "<ul>";
                    for ($i=0; $i < count($empleadosCambiados) - 1; $i++) { 
                        print "<li>".$empleadosCambiados[$i]["emp_no"]." | ".$empleadosCambiados[$i]["nombre"]."</li>";
                    }
                    print "</ul>";
                }
                if(count($empleadosTrabajando) > 1)
                {
                    print "<h4>Empleados Actuales</h4>";
                    print "<ul>";
                    for ($i=0; $i < count($empleadosTrabajando) - 1; $i++) { 
                        print "<li>".$empleadosTrabajando[$i]["emp_no"]." | ".$empleadosTrabajando[$i]["nombre"]."</li>";
                    }
                    print "</ul>";
                }
            }
        ?>

		<form id="" name="" action="" method="post" >
		
		<div >
			Departamento <select name="departamentos" id="departamentos" required>
                <?php
                    foreach ($departamentos as $departamento => $titulo) {
                        print "<option value='".$titulo["dept_no"]."'>".$titulo["dept_no"]." | ".$titulo["dept_name"]."</option>";
                    }
                ?>
            </select>
        </div>		
        
		<input type="submit" name="infDept" value="Saber Informacion Departamento">
        </form>
		
	    </div>
        <a href="controller_welcome.php">Volver a la Pagina Principal</a>
        <a href="controller_cerrarSession.php">Cerrar Sesion</a>
    </div>
    </div>
    </div>
</body>
</html>