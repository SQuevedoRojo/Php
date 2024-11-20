<?php
include_once "media7func.php";
/* Nombre Alumno:  Sergio Quevedo Rojo      */

    list($jugadores,$cantidadApostada,$cartasARepartir) = recogerDatos();
    asignarCartasAJugadores($jugadores,$cartasARepartir);
    mostrarCartasPorJugador($jugadores);
    $puntuacionJugadores = sumarPuntuacionJugadores($jugadores);
    imprimirPuntuaciones($puntuacionJugadores);
    $ganadores = saberGanadores($puntuacionJugadores);
    $hayGanadores = mostrarGanadores($ganadores,$cantidadApostada);
    guardarResultadoDeLaRonda($hayGanadores,$puntuacionJugadores)
?>