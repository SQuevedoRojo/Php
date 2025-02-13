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

		<form id="" name="" action="" method="post" >	

		<div >
			Canciones <select name="canciones" id="canciones" required>
                <?php
                    foreach ($canciones as $cancione => $titulo) {
                        print "<option value='".$titulo["TrackId"]."'>".$titulo["TrackId"]." | ".$titulo["TName"]." | ".$titulo["ATitle"]." | ".$titulo["ArName"]." | ".$titulo["MName"]." | ".$titulo["GName"]." | ".$titulo["TComposer"]." | ".$titulo["TUnitPrice"]."</option>";
                    }
                ?>
            </select>
        </div>		
        
        <input type="submit" name="aumentarIndice" value="Mostrar 20 Canciones Siguientes">
		<input type="submit" name="disminuirIndice" value="Mostrar 20 Canciones Anteriores">
		<input type="submit" name="cesta" value="Añadir a la Cesta">
		<input type="submit" name="descargar" value="Descargar Canciones">
        </form>
		
	    </div>
        <a href="controller_welcome.php">Volver a la Pagina Principal</a><br>
        <a href="controller_cerrarSession.php">Cerrar Sesion</a>
    </div>
    </div>
    </div>
</body>
</html>