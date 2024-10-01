<HTML>
    <HEAD><TITLE>Bingo</TITLE></HEAD>
    <BODY>
    <?php

    /* Función para eliminar un número de los cartones */
    function eliminarNumero(&$jugadores, $numeroAEliminar, &$aciertosBingo, $indice)
    {
        foreach ($jugadores as $jugador => &$cartones)
        {
            $indiceCarton = 0;
            foreach ($cartones as &$fila)
            {
                foreach ($fila as $key => $numero)
                {
                    if ($numero === $numeroAEliminar)
                    {
                        // En vez de eliminar el número,creamos un array interno que se usará para seleccionar el color de fondo despues.
                        $fila[$key] = array('numero' => $numero, 'eliminado' => true);
                        $aciertosBingo[$indice][$indiceCarton] += 1;
                    }
                } 
                $indiceCarton += 1;
            }
        }
    }

    /* Comprobar que carton es el ganador */
    function comprobarBingo(&$aciertosBingo)
    {
        for ($i = 0; $i < 4; $i++)
        {
            for ($j = 0; $j < 3; $j++)
            {
                if ($aciertosBingo[$i][$j] == 15) 
                    return $i;
            }
        }
        return -1;
    }

    /* Funcion para mostrar las bolas */
    function mostrarBolas($numerosEliminados)
    {
        echo "<b  style=\"padding-left:31vw;\" >BOLAS QUE HAN SALIDO </b><br/>";
        echo "<div style=\"border: 1px solid black;float:right; border-radius: 2vw; width:55%;\">"; 

        foreach ($numerosEliminados as $num) {
            echo "<img src=\"images/".($num.".PNG") ."\" width=\"50\" heigth=\"42\" style=\"visibility:visible;padding:1vw;\" />";        
        }
        echo "</div>";
    }



    /* Función auxiliar para imprimir casillas con o sin estilo de fondo rojo */
    function imprimirCasilla($numero)
    {
        $linea = "";

        // Comprueba que 'numero' sea un array, que dentro de ese array haya una key llamada 'eliminado' y comprueba que ese valor sea 'true'
        if (is_array($numero) && isset($numero['eliminado']) && $numero['eliminado'])
            $linea = "<p style='background-color:red'>" . $numero['numero'] . "</p>";
        else
            $linea = $numero;

        return $linea;
    }
    
    /* Funcion para imprimir todos los cartones */ 
    function mostrarCartones($j1, $j2, $j3, $j4)
    {
        $jc1 = $j1;
        $jc2 = $j2;
        $jc3 = $j3;
        $jc4 = $j4;
        $nombreJugador = "jc";

        for ($i = 1; $i <= 4 ; $i++)
        { 
            $jugadorActual = ${$nombreJugador.$i};
            echo "<div style='float:left;padding-left:1vw;'>";
            foreach($jugadorActual as $jugador => $cartones)
            {
                echo "<h3>Jugador: $i</h3>";
                for ($j = 0; $j < 3; $j++)
                {
                    echo "CARTÓN " . ($j + 1);
                    echo "<table border='1'>";
                    
                    // Primera fila del cartón
                    echo "<tr>";
                    echo "<th>" . imprimirCasilla($cartones[$j][0]) . "</th>";
                    echo "<th class='vacio' style='background-color:lightblue'></th>";
                    echo "<th>" . imprimirCasilla($cartones[$j][4]) . "</th>";
                    echo "<th>" . imprimirCasilla($cartones[$j][7]) . "</th>";
                    echo "<th>" . imprimirCasilla($cartones[$j][9]) . "</th>";
                    echo "<th>" . imprimirCasilla($cartones[$j][11]) . "</th>";
                    echo "<th class='vacio' style='background-color:lightblue'></th>";
                    echo "</tr>";

                    // Segunda fila del cartón
                    echo "<tr>";
                    echo "<th>" . imprimirCasilla($cartones[$j][1]) . "</th>";
                    echo "<th>" . imprimirCasilla($cartones[$j][2]) . "</th>";
                    echo "<th>" . imprimirCasilla($cartones[$j][5]) . "</th>";
                    echo "<th class='vacio' style='background-color:lightblue'></th>";
                    echo "<th class='vacio' style='background-color:lightblue'></th>";
                    echo "<th>" . imprimirCasilla($cartones[$j][12]) . "</th>";
                    echo "<th>" . imprimirCasilla($cartones[$j][14]) . "</th>";
                    echo "</tr>";

                    // Tercera fila del cartón
                    echo "<tr>";
                    echo "<th class='vacio' style='background-color:lightblue'></th>";
                    echo "<th>" . imprimirCasilla($cartones[$j][3]) . "</th>";
                    echo "<th>" . imprimirCasilla($cartones[$j][6]) . "</th>";
                    echo "<th>" . imprimirCasilla($cartones[$j][8]) . "</th>";
                    echo "<th>" . imprimirCasilla($cartones[$j][10]) . "</th>";
                    echo "<th>" . imprimirCasilla($cartones[$j][13]) . "</th>";
                    echo "<th class='vacio' style='background-color:lightblue'></th>";
                    echo "</tr>";

                    echo "</table>";
                    echo "<br><br>";
                }
            }
            echo "</div>";
        }
    }

    /* -------------------------------------------------------------------------------------------------------- */

    /* Creación de la estructura de datos de los jugadores */
    $j1 = array("Jugador 1" => array(array(),array())); 
    $j2 = array("Jugador 2" => array(array(),array())); 
    $j3 = array("Jugador 3" => array(array(),array())); 
    $j4 = array("Jugador 4" => array(array(),array())); 

    $numerosRepetidos = array();
    $nombreJugador = "j";

    /* Creación de los cartones de cada jugador */
    for ($z=1; $z <= 4 ; $z++)
    { 
        $jugadorActual = &${$nombreJugador.$z};

        foreach($jugadorActual as $jugador => &$cartones)
        {
            for ($fila=0; $fila < 3; $fila++)
            {
                // Rellena el array con 60 posiciones en false
                $numerosRepetidos = array_fill(0, 60, false);

                $control1 = 1;
                $control2 = 9;

                for ($numero=0; $numero < 15; $numero++)
                { 
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

                    // Filtro control numeros cartones
                    if ($numero == 1) {
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
                    elseif($numero == 13){
                        $control1 = 60;$control2 = 60;
                    }
                }

                // Ordena el array de menor a mayor
                sort($cartones[$fila]);
            }
        }
    }


    /* -------------------------------------------------------------------------------------------------------- */

    /* COMIENZO DEL JUEGO */

    $numerosEliminados = array();
    $seguir = true;
    $aciertosBingo = array(array(0,0,0),array(0,0,0),array(0,0,0),array(0,0,0));
    $ganador = -1;

    while ($seguir)
    {
        $numeroAEliminar = rand(1, 60);

        // Si el numeroAEliminar no está dentro del array $numerosEliminados
        if (!in_array($numeroAEliminar, $numerosEliminados))
        {
            $numerosEliminados[] = $numeroAEliminar;

            for ($j = 1; $j <= 4; $j++)
                eliminarNumero(${$nombreJugador.$j}, $numeroAEliminar, $aciertosBingo, $j-1);

            $ganador = comprobarBingo($aciertosBingo);
            $seguir = ($ganador === -1); // Si hay un ganador, el juego termina
        }
    }

    mostrarCartones($j1, $j2, $j3, $j4);

    mostrarBolas($numerosEliminados);

    if ($ganador !== -1)
        echo "<h2 style='padding-top:26vw;'>¡El ganador es el Jugador " . ($ganador + 1) . "!</h2>";
    
    ?>
    </BODY>
</HTML>