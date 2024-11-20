<?php
    include_once "media7funcerror.php";

    //Funcion que recoge los datos del formulario y devuelve un arreglo con los datos obtenidos
    function recogerDatos()
    {
        $jugadores = array();
        $contadorJugadores = null;
        $cantidadApostada = intval(limpiar($_POST['apuesta']));
        $cartasARepartir = intval(limpiar($_POST['numcartas']));
        for ($i=0; $i < 4; $i++) { 
            $nombreGenerico = "nombre" . (strval($i+1));
            $valorNombre = limpiar($_POST[$nombreGenerico]);
            if($valorNombre != null)
            {
                $jugadores[$valorNombre] = array();
                $contadorJugadores += 1;
            }
        }
        if($contadorJugadores < 2)
            trigger_error("Debe haber un minimo de 2 jugadores",E_USER_WARNING);
        if($cartasARepartir < 2 || $cartasARepartir > 10)
            trigger_error("Se deben repartir un minimo de 2 cartas o un máximo de 10 cartas",E_USER_WARNING);
        if($cantidadApostada < 0 || $cantidadApostada == null)
            trigger_error("La cantidad apostada tiene que ser un numero positivo",E_USER_WARNING);
        return [$jugadores,$cantidadApostada,$cartasARepartir];
    }

    //Funcion que recibe un parametro y lo devuelve quitando los espacios y caracteres especiales
    function limpiar($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Funcion que asigna cartas aletoriamente a los jugadores 
    function asignarCartasAJugadores(&$jugadores,$cartasARepartir)
    {
        foreach ($jugadores as $nombre => &$cartas) {
            for ($i=0; $i < $cartasARepartir; $i++) {
                $carta = null;
                do{ 
                    $carta = numeroCartaAleatorio() . paloCartaAleatorio();
                }while(comprobarCartasRepetidas($jugadores,$carta));
                array_push($cartas,$carta);
            }
        }
    }

    //Funcion que comprueba que no se repitan las cartas que se generan aleatoriamente en todos los jugadores
    function comprobarCartasRepetidas($jugadores,$carta)
    {
        $repetida = null;
        foreach ($jugadores as $nombre => &$cartas) {
            if(in_array($carta,$cartas))
                $repetida = true;
        }
        return $repetida;
    }

    //Funcion que asigna un palo aleatorio de la baraja española
    function paloCartaAleatorio()
    {
        $paloCarta = rand(1,4);
        $palo = null;
        switch ($paloCarta) {
            case 1:
                $palo = "B" ; //BASTOS
                break;
            case 2:
                $palo = "C" ; //COPAS
                break;
            case 3:
                $palo = "E" ; //ESPADAS
                break;
            case 4:
                $palo = "O" ; //ORO
                break;
        }
        return $palo;
    }

    //Funcion que asigna un numero aletorio del rango 1..12 sin contar el 8 y el 9
    function numeroCartaAleatorio()
    {
        $numeroCarta = null;
        do{
            $numeroCarta = rand(1,12);
        }while ($numeroCarta == 8 || $numeroCarta == 9);
        switch ($numeroCarta) {
            case 10:
                $numeroCarta = "S"; // SOTA
                break;
            case 11:
                $numeroCarta = "C"; //CABALLO
                break;
            case 12:
                $numeroCarta = "R"; //REY
                break;
        }
        return strval($numeroCarta);
    }

    //Funcion que imprime las cartas de cada jugador
    function mostrarCartasPorJugador($jugadores)
    {
        imprimirCabeceraTabla();
        foreach ($jugadores as $nombre => $cartas) {
            print "<tr><th>".$nombre."</th>";
            foreach ($cartas as $carta) {
                print "<td><img src='images/".($carta.".PNG")."'></td>";
            }
            print "</tr>";
        }
        imprimirFinalTabla();
    }

    //Funcion que imprime la cabecera de la tabla de las cartas
    function imprimirCabeceraTabla()
    {
        print "<table border='1'>";
    }

    //Funcion que imprime el final de la tabla de las cartas
    function imprimirFinalTabla()
    {
        print "</table>";
    }

    //Funcion que suma las puntuaciones de las cartas de cada jugador
    function sumarPuntuacionJugadores($jugadores)
    {
        $puntuacionJugadores = array();
        foreach ($jugadores as $nombre => $cartas) {
            $puntuacionJugadores[$nombre] = null;
            foreach($cartas as $carta)
            {
                $valorCarta = substr($carta,0,1);
                $puntuacionJugadores[$nombre] += saberValorCarta($valorCarta); 
            }
        }
        return $puntuacionJugadores;
    }

    //Funcion que devuelve el valor de la carta con la siguiente consideracion. REY,CABALLO,SOTA = 0.5p ; CARTAS 1..7 = VALOR CARTA
    function saberValorCarta($puntuacionCarta)
    {
        switch ($puntuacionCarta) {
            case 'S': case 'R': case 'C' :
                $puntuacionCarta = 0.5;
                break;
        }
        return floatval($puntuacionCarta);
    }

    //Funcion que imprime los ganadores en pantalla
    function imprimirPuntuaciones($puntuacionJugadores)
    {
        print "<br>";
        foreach ($puntuacionJugadores as $nombre => $puntuacion) {
            print $nombre . " --> " . $puntuacion . "<br>";
        }
        print "<br>";
    }

    //Funcion que devuelve los ganadores considerando que la puntuacin maxima que pueden tener es de 7.5p
    function saberGanadores($puntuacionJugadores)
    {
        $ganadores = array();
        $ganadoresCon7yMedio = null;
        foreach ($puntuacionJugadores as $nombre => $puntuacion) {
            if($puntuacion == 7.5)
                $ganadoresCon7yMedio = $ganadoresCon7yMedio . $nombre . "#";
            elseif($puntuacion <= 7.5)
                $ganadores[$nombre] = $puntuacion;
        }
        if(strlen($ganadoresCon7yMedio) > 0)
        {
            $ganadores = null;
            $ganadoresCon7yMedio = explode("#",$ganadoresCon7yMedio);
            for ($i=0; $i < count($ganadoresCon7yMedio) - 1; $i++) { 
                $ganadores[$ganadoresCon7yMedio[$i]] = 7.5;
            }
        }
        return $ganadores;
    }

    //Funcion que muestra los Ganadores de la Partida
    function mostrarGanadores($ganadores,$premio)
    {
        $hayGanadores = array();
        if(count($ganadores) > 0)
        {
            $premioTotal = $premio /(count($ganadores));
            print "Ganadores : |";
            foreach ($ganadores as $nombre => $puntuacion) { 
                print $nombre . " | ";
                $hayGanadores[$nombre] = $puntuacion."**".$premioTotal;
            }
            print "<br>";
            print "Premios : ";
            foreach ($ganadores as $nombre => $puntuacion) { 
                print $nombre . " --> " .  $premioTotal . "<br>";
            }
            
        }
        else
        {
            print "No hay Ganadores esta Ronda <br>";
            print "Premios : Bote --> " . $premio;
            $hayGanadores = null;
        }
        return $hayGanadores;
    }

    //Funcion que guarda en un fichero el nombre,puntuacion y premio de cada jugador
    function guardarResultadoDeLaRonda($hayGanadores,$puntuacionJugadores)
    {
        $file = fopen("apuestas.txt","w");
        if($hayGanadores != null)
        {
            $jugadoresYaEscritos = array();
            foreach($hayGanadores as $nombre => $contenido)
            {
                $jugadoresYaEscritos[] = $nombre;
                $cadena = $nombre."**".$contenido."\n";
                fwrite($file,$cadena);
            }
            foreach ($puntuacionJugadores as $nombre => $puntuacion) {
                if(!in_array($nombre,$jugadoresYaEscritos))
                {
                    $cadena = $nombre."**".$puntuacion."**0\n";
                    fwrite($file,$cadena);
                }
            }
        }
        else
        {
            foreach ($puntuacionJugadores as $nombre => $puntuacion) {
                    $cadena = $nombre."**".$puntuacion."**0\n";
                    fwrite($file,$cadena);
            }
        }
        fclose($file);
    }
?>