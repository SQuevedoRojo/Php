<HTML>
    <HEAD><TITLE>Bingo</TITLE></HEAD>
    <BODY>
    <?php

   /*Creacion de la estructura de datos de los jugadores*/
   $j1 = array("Jugador 1" => array(array(),array())); 
   $j2 = array("Jugador 2" => array(array(),array())); 
   $j3 = array("Jugador 3" => array(array(),array())); 
   $j4 = array("Jugador 4" => array(array(),array())); 

   $numerosRepetidos = array();
   $nombreJugador = "j";

   /*Creacion de los cartones de cada jugador*/
   for ($z=1; $z <= 4 ; $z++) { 
    $jugadorActual = &${$nombreJugador.$z};
    foreach($jugadorActual as $jugador => &$cartones)
    {
        for ($fila=0; $fila < 3; $fila++) { 
            for ($i=0; $i < 60; $i++) { 
                $numerosRepetidos[$i] = false;
            }
            $control1 = 1;
            $control2 = 9;
            for ($numero=0; $numero < 15; $numero++) { 
                $repetir = false;
                
                do {
                    $num = rand($control1,$control2);
                    if ($numerosRepetidos[$num-1] == false)
                    {
                        $cartones[$fila][$numero] = $num;
                        $numerosRepetidos[$num-1] = true;
                        $repetir = false;
                    }
                    else
                        $repetir = true;
                } while ($repetir);
                if ($numero == 1) 
                {
                    $control1 = 10;$control2 = 19;
                }
                elseif ($numero == 3) {
                    $control1 = 20;$control2 = 29;
                }
                elseif ($numero == 6) {
                    $control1 = 30;$control2 = 39;
                }
                elseif ($numero == 8) {
                    $control1 = 40;$control2 = 49;
                }
                elseif ($numero == 10){
                    $control1 = 50;$control2 = 59;
                }
                elseif($numero == 13)
                {
                    $control1 = 60;$control2 = 60;
                }
            }
            sort($cartones[$fila]);

        }

        }
    }

    /*Generacion de numeros del Bingo */
    $numerosEliminados = array();
    $seguir = true;
    while($seguir)
    {
        do{
            $bolaBingo = rand(1,60);
        }while($numerosRepetidos[$num-1] == false);
        $numerosEliminados[] = $bolaBingo;
        eliminarNumero($bolaBingo,$j1,$j2,$j3,$j4);
        
        $seguir = comprobarBingo($j1,$j2,$j3,$j4);
    }
    mostrarCartones($j1,$j2,$j3,$j4);
        
    var_dump($j1);
    var_dump($j2);
    var_dump($j3);
    var_dump($j4);

    /* Función para eliminar un número de los cartones */
    function eliminarNumero($numeroAEliminar,$j1,$j2,$j3,$j4)
    {
        $nombreJugador = "j";
        for ($z=1; $z <= 4 ; $z++) { 
            $jugadorActual = &${$nombreJugador.$z};
            foreach ($jugadorActual as $jugador => &$cartones)
            {
                foreach ($cartones as &$fila)
                {
                    foreach ($fila as $key => &$numero)
                    {
                        if ($numero == $numeroAEliminar)
                        {
                            unset($fila[$key]);
                            $fila[$key] = 'X';
                        }
                    } 
                }
            }
        }    
    }

    // Imprimir todos los cartones 
    function mostrarCartones($j1,$j2,$j3,$j4)
    {
        $nombreJugador = "j";
        for ($i=1; $i <= 4 ; $i++)
        { 
            $jugadorActual = ${$nombreJugador.$i};
            echo "<h3>Jugador: $i</h3>";
            
            foreach($jugadorActual as $jugador => $cartones)
            {
                for ($j=0; $j < 3; $j++)
                { 
                    echo "CARTÓN " . ($j + 1);
                    echo "<table border='1'>";
                    echo "<tr><th>". ($cartones[$j][0]) ."</th><th class='vacio' style='background-color:lightblue'></th><th>". ($cartones[$j][4]) ."</th><th>". ($cartones[$j][7]) ."</th><th>". ($cartones[$j][9]) ."</th><th>". ($cartones[$j][11]) ."</th><th class='vacio' style='background-color:lightblue'></th></tr>";
                    echo "<tr> <th>". ($cartones[$j][1]) ."</th><th>". ($cartones[$j][2]) ."</th><th>". ($cartones[$j][5]) ."</th><th class='vacio' style='background-color:lightblue'></th><th class='vacio' style='background-color:lightblue'></th><th>". ($cartones[$j][12]) ."</th><th>". ($cartones[$j][14]) ."</th></tr>";
                    echo "<tr><th class='vacio' style='background-color:lightblue'></th><th>". ($cartones[$j][3]) ."</th><th>". ($cartones[$j][6]) ."</th><th>". ($cartones[$j][8]) ."</th><th>". ($cartones[$j][10]) ."</th><th>". ($cartones[$j][13]) ."</th><th class='vacio' style='background-color:lightblue'></th></tr>";
                    echo "</table>";
                    echo "<br><br>";
                }
            }
        }
    }

    function comprobarBingo($j1,$j2,$j3,$j4)
    {
        $bingo = true;
        $nombreJugador = "j";
        for ($z=1; $z <= 4 && $bingo; $z++) { 
            $jugadorActual = &${$nombreJugador.$z};
            foreach ($jugadorActual as $jugador => &$cartones)
            {
                foreach ($cartones as &$fila)
                {
                    $contadorNumeros = 0;
                    foreach ($fila as $key => $numero)
                    {
                        if ($numero == 'X')
                        {
                            $contadorNumeros += 1;
                        }
                    } 
                    if($contadorNumeros == 15)
                        $bingo = false;
                }
            }
        }
        return $bingo;
    }
       

?>
</BODY>
</HTML>