<?php
$nombre = limpiar($_REQUEST['nombre']);
$apellidos = limpiar($_REQUEST['ape1'])." ".limpiar($_REQUEST['ape2']);
$email = $_REQUEST['email'];
$sexo = $_REQUEST['sexo'];
$caracterSexo = $sexo === 'hombre' ? 'H' : 'M';


print "<table border='1'>";
print "<tr><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Sexo</th></tr>";
print "<tr><th>$nombre</th><th>$apellidos</th><th>$email</th><th>$caracterSexo</th></tr>";

$file = fopen("datos.txt",'w');
fwrite($file, "Nombre : $nombre" . PHP_EOL);
fwrite($file, "Apellidos : $apellidos" . PHP_EOL);
fwrite($file, "Email : $email" . PHP_EOL);
fwrite($file, "Sexo : $caracterSexo" . PHP_EOL);
fclose($file);


function limpiar($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>