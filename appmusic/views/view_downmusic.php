<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Descargar Musica</title>
 </head>

<body>

    <div class="container ">
        <!--Aplicacion-->
		<div  style="max-width: 30rem;">
		<div>

        <?php
            if($cesta != null)
            {
                echo "<div id='cesta'>";
                print "<table border='1'><tr><th>Id Cancion</th><th>Nombre Cancion</th><th>Precio</th></tr>";
                
                foreach ($cesta as $productoCesta => $detalles) {
                    print "<tr><td>".$detalles[0]."</td><td>".$detalles[1]."</td><td>".$detalles[2]."€</td></tr>";
                }
                print "</tr>";
                echo "</div>";
            }
        ?>

		<form id="" name="" action="" method="post" >	

		<div >
			Canciones <select name="canciones" id="canciones" required>
                <?php
                    foreach ($canciones as $cancione => $titulo) {
                        print "<option value='".$titulo["TrackId"]."|".$titulo["TName"]."|".$titulo["TUnitPrice"]."'>".$titulo["TrackId"]." | ".$titulo["TName"]." | ".$titulo["ATitle"]." | ".$titulo["ArName"]." | ".$titulo["MName"]." | ".$titulo["GName"]." | ".$titulo["TComposer"]." | ".$titulo["TUnitPrice"]."</option>";
                    }
                ?>
            </select>
        </div>		

        <input type="submit" name="disminuirIndice" value="Mostrar 20 Canciones Anteriores">
        <input type="submit" name="aumentarIndice" value="Mostrar 20 Canciones Siguientes">
		<br>
		<input type="submit" name="cesta" value="Añadir a la Cesta">
        <input type="submit" name="Ecesta" value="Eliminar la Cesta">
		<input type="submit" name="descargar" value="Descargar Canciones">
        </form>
		<br>
	    </div>
        <a href="controller_welcome.php">Volver a la Pagina Principal</a><br>
        <a href="controller_cerrarSession.php">Cerrar Sesion</a>
    </div>
    </div>
    </div>
</body>
</html>