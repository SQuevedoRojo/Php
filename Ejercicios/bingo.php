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

        foreach($j1 as $jugador => $cartones)
        {
            
            for ($fila=0; $fila < 3; $fila++) { 
                for ($i=0; $i < 60; $i++) { 
                    $numerosRepetidos[$i] = false;
                }
                $control1 = 1;
                $control2 = 10;
                for ($numero=0; $numero < 15; $numero++) { 
                    $repetir = false;
                    
                    do {
                        $num = rand($control1,$control2);
                        if ($numerosRepetidos[$num-1] == false)
                        {
                            $cartones[$fila][$numero] = $num;
                            $numerosRepetidos[$num-1] = true;
                            $repetir = false;
                            echo "numero puesto carton ". ($fila+1) ."    ". $cartones[$fila][$numero] ."  <br>";
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
                var_dump($cartones[$fila]);
            }
            
        }
    

?>
</BODY>
</HTML>