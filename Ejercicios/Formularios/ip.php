<?php

    $ip = explode('.',$_REQUEST['ip']);
    
    operacionIP($ip);
        
    function operacionIP($ip)
    {
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
            IpBinario($ip,$ipOriginal);
        }
        else
            imprimir(0,0,false);
    }

    function IpBinario($ip,$ipOriginal)
    {
        for ($i=0; $i < count($ip); $i++)
        { 
            $ip[$i] = decbin($ip[$i]);
        }

        $ipOr = implode('.',$ipOriginal);

        $ipBin = implode('.',$ip);

        imprimir($ipOr,$ipBin,true);
    }

    function imprimir($ipOr,$ipBin,$correcto)
    {
        if($correcto)
        {
            print "IP :<input type='text' name='ip' value='$ipOr'><br>";
            print "IP Binario :<input type='text' name='ip' value='$ipBin'><br>";
        }
        else
        print "IP Binario :<input type='text' name='ip' value='La IP no es correcta'><br>";
    }
?>