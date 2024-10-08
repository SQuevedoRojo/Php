<?php

$ip = explode('.',$_REQUEST['ip']);
$ipOriginal = $ip;
$correcto = true;
$indice = 0;

while($correcto && $indice < 4)
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

    $ipOr = implode('.',$ipOriginal);

    $ipBin = implode('.',$ip);

    print "IP :<input type='text' name='ip' value='$ipOr'><br>";
    print "IP Binario :<input type='text' name='ip' value='$ipBin'><br>";

}
else
    print "IP Binario :<input type='text' name='ip' value='La IP no es correcta'><br>";
?>