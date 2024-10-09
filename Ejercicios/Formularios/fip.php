<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IP</title>
</head>
<body>
    <h1>IPs</h1>
    <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
        IP :<input type="text" name="ip"><br>
        <input type="submit" value="enviar">
        <input type="reset" value="borrar">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
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
    }
    ?>
</body>
</html>