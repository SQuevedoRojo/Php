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
                for ($numero=0; $numero < 15; $numero++) { 
                    $repetir = false;
                    do {
                        $num = rand(1,60);
                        if ($numerosRepetidos[$num-1] == false)
                        {
                            $cartones[$fila][$numero] = $num;
                            $numerosRepetidos[$num] = true;
                            $repetir = false;
                            echo "numero puesto carton ". ($fila+1) ."    ". $cartones[$fila][$numero] ."  <br>";
                        }
                        else
                            $repetir = true;
                    } while ($repetir);
                }
                
            }
            
        }

        $indice = 1;

        foreach($j1 as $jugador => $cartones)
        {
            echo "<h2>Carton ". $indice ."</h2><br>";
            foreach ($cartones as $c){
            for ($fil=0; $fil < 3 ;$fil++) { 
                for ($numer=0; $numer < 15 ; $numer++) { 
                    echo "  ". $c[$fil][$numer] ."  ";
                }
                }
            }
            $indice += 1;
            
        }

?>
</BODY>
</HTML>