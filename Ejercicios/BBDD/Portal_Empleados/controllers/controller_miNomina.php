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
        list($infoPerosnal,$salarios,$titulaciones,$departamentos) = saberVidaLaboral($empleado);
        $conceptos = array();
        $salarioOriginal = intval($salarios[0]["salary"]);
        $salarioNeto = $salarioOriginal;
        $salarioNeto = $salarioOriginal - ($salarioOriginal*0.075);
        $conceptos[] = "Descuento del 7.5% de la Seguridad Social";
        if($salarioOriginal < 40000)
        {
            $salarioNeto = $salarioNeto - ($salarioOriginal - ($salarioOriginal*0.01));
            $conceptos[] = "Descuento del 10% del IRPF";
        }
        elseif($salarioOriginal >=40000 && $salarioOriginal <= 70000)
        {
            $salarioNeto = $salarioNeto - ($salarioOriginal - ($salarioOriginal*0.02));
            $conceptos[] = "Descuento del 20% del IRPF";
        }
        else
        {
            $salarioNeto = $salarioNeto - ($salarioOriginal - ($salarioOriginal*0.03));
            $conceptos[] = "Descuento del 30% del IRPF";
        }
        if(substr_count(strtolower($titulaciones[0]["title"]),"engineer") != 0)
        {
            $salarioNeto += 10000;
            $conceptos[] = "Complemento de 10000€ por pertenecer a la Categoria Engineer";
        }

    }

    require_once ("../views/view_miNomina.php");

?>