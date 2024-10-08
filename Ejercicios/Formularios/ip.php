<?php

$ip = explode('.',$_REQUEST['ip']);
$ipOriginal = $ip;
$correcto = true;
$indice = 0;

while($correcto)
{
    if($ip[$indice] < 0 || $ip[$indice] > 255)
        $correcto = false;
    $indice += 1;
}

if($correcto)
{
    for ($i=0; $i < count($ip); $i++)
    { 
        $ip[$i] = decbin($ip[$i]);
    }

    echo "La IP " . $ipOriginal[0]. "." . $ipOriginal[1]. "." . $ipOriginal[2]. "." . $ipOriginal[3] . " en binario es " . $ip[0]. "." . $ip[1]. "." . $ip[2]. "." . $ip[3];
}
else
    echo "La IP no es Correcta";
?>