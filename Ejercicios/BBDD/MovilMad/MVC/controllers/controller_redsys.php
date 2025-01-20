<?php
    
    
    
    function redireccionarPago($cantidadTotal)
    {
        include_once ("../tpv/apiRedsys.php");
        // Se crea Objeto
        $miObj = new RedsysAPI;

        $fuc="263100000";
        $terminal="6";
        $moneda="978";
        $trans="0";
        $url="";
        $id=time();
        $urlOKKO="http://192.168.206.222/Php/Ejercicios/BBDD/MovilMad/MVC/controllers/controller_respuestaCompra.php";
        $amount=intval($cantidadTotal*100);	
        // Se Rellenan los campos
        $miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
        $miObj->setParameter("DS_MERCHANT_ORDER",$id);
        $miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);
        $miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);
        $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
        $miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
        $miObj->setParameter("DS_MERCHANT_MERCHANTURL",$url);
        $miObj->setParameter("DS_MERCHANT_URLOK",$urlOKKO);
        $miObj->setParameter("DS_MERCHANT_URLKO",$urlOKKO);

        //Datos de configuración
        $version="HMAC_SHA256_V1";
        $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//Clave recuperada de CANALES
        // Se generan los parámetros de la petición
        $request = "";
        $params = $miObj->createMerchantParameters();
        $signature = $miObj->createMerchantSignature($kc);
        return [$params,$signature,$version];
    }
?>