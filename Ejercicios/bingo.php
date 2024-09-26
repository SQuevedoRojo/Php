<HTML>
<H1> Bingo </H1>
<BODY>

<?php

   /*Creacion de la estructura de datos de los jugadores*/
   $j1 = array("Jugador 1" => array(array(),array())); 
   $j2 = array("Jugador 2" => array(array(),array())); 
   $j3 = array("Jugador 3" => array(array(),array())); 
   $j4 = array("Jugador 4" => array(array(),array())); 

   $numerosRepetidos = array();

   /*Creacion de los cartones de cada jugador*/
   $nombreJugador = "j";

   for ($i=1; $i <= 4 ; $i++) { 
    foreach (${$nombreJugador.$i} as $jugador => $cartones) { 
        {
            
            for ($fila=0; $fila < 3; $fila++) { 
                for ($i=0; $i < 60; $i++) { 
                    $numerosRepetidos[$i] = false;
                }
                for ($numero=0; $numero < 15; $numero++) { 
                    $repetir = false;
                    do {
                        $num = rand(1,60);
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
                        $control1 = 11;$control2 = 19;
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
            var_dump($cartones);

        }
        for ($i=1; $i <= 4 ; $i++) 
        { 
            foreach (${$nombreJugador.$i} as $jugador => $cartones) 
            { 
                echo "<br>". ${$nombreJugador.$i} ."<br>";
                for ($j=0; $j < 3; $j++) 
                { 
                    sort($cartones[$j]);
                    echo "CARTÓN " . ($j+1);
                    echo "<table>";
                    echo "<table border = 1>";
                    echo "<tr><th>".$cartones[$j][0]."</th><th class=\"vacio\" style=\"background-color:lightblue\">  </th><th>".$cartones[$j][4]."</th><th>".$cartones[$j][7]."</th><th>".$cartones[$j][9]."</th><th>".$cartones[$j][11]."</th><th class=\"vacio\" style=\"background-color:lightblue\"></th></tr>";
                    echo "<tr><th>".$cartones[$j][1]."</th><th>".$cartones[$j][2]."</th><th>".$cartones[$j][5]."</th><th class=\"vacio\" style=\"background-color:lightblue\">  </th><th class=\"vacio\" style=\"background-color:lightblue\">  </th><th>".$cartones[$j][12]."<th>".$cartones[$j][14]."</th>";
                    echo "<tr><th class=\"vacio\" style=\"background-color:lightblue\">  </th><th>".$cartones[$j][3]."</th><th>".$cartones[$j][6]."</th><th>".$cartones[$j][8]."</th><th>".$cartones[$j][10]."</th><th>".$cartones[$j][13]."</th><th class=\"vacio\" style=\"background-color:lightblue\"></th></tr>";
                    echo "</table>";
                            
                }
          }
        }
    }
    
    

?>
</BODY>
</HTML>