<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");    
    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: ../index.php");
    }
    var_dump($_SESSION);

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $empleado = devolverId();
        require_once ("../db/db.php");
        require_once ("../models/model_miNomina.php");
        list($infoPersonal,$salarios,$titulaciones,$departamentos) = saberVidaLaboral($empleado);
        $conceptos = array();
        $salarioOriginal = intval($salarios[0]["salary"]);
        $salarioNeto = $salarioOriginal;
        $descSegSoc = ($salarioOriginal*0.075);
        $salarioNeto -= $descSegSoc;
        $conceptos[] = "Descuento del 7.5% de la Seguridad Social";
        if($salarioOriginal < 40000)
        {
            $descIRPF = ($salarioOriginal*0.1);
            $salarioNeto -= $descIRPF;
            $conceptos[] = "Descuento del 10% del IRPF";
        }
        elseif($salarioOriginal >=40000 && $salarioOriginal <= 70000)
        {
            $descIRPF = ($salarioOriginal*0.2);
            $salarioNeto -= $descIRPF;
            $conceptos[] = "Descuento del 20% del IRPF";
        }
        else
        {
            $descIRPF = ($salarioOriginal*0.3);
            $salarioNeto -= $descIRPF;
            $conceptos[] = "Descuento del 30% del IRPF";
        }
        if(substr_count(strtolower($titulaciones[0]["title"]),"engineer") != 0)
        {
            $complemetoIng = 10000;
            $salarioNeto += $complemetoIng;
            $conceptos[] = "Complemento de 10000€ por pertenecer a la Categoria Engineer";
        }
    }

    require_once ("../views/view_miNomina.php");

?>