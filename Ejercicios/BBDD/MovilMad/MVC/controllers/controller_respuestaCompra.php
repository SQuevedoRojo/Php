<?php

    require_once "controller_comunes.php";
    require_once "controller_session.php";
    require_once "../tpv/apiRedsys.php";
    require_once ("../db/db.php");
    iniciarSession();
    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: ../index.php");
    }

    var_dump($_SESSION);

    // Se crea Objeto
    $miObj = new RedsysAPI;

    if (!empty( $_POST ) ) 
    {//URL DE RESP. ONLINE
                        
        $version = $_POST["Ds_SignatureVersion"];
        $datos = $_POST["Ds_MerchantParameters"];
        $signatureRecibida = $_POST["Ds_Signature"];

        $decodec = $miObj->decodeMerchantParameters($datos);	
        
        $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
        $firma = $miObj->createMerchantSignatureNotif($kc,$datos);	

        if ($firma === $signatureRecibida){
            $codigoRespuesta = intval($miObj->getParameter("Ds_Response"));
            if($codigoRespuesta >= 0 && $codigoRespuesta < 100)
            {
                print "<h2><strong>Compra Realizada Con Exito</h2></strong>";
                $datosCompra = json_decode($decodec,true);
                if ($datosCompra !== null && isset($datosCompra['Ds_Amount']))
                {
                    $precioCompra = intval($datosCompra['Ds_Amount'])/100;
                    require_once "../models/model_devolver.php";
                    insertarPago($precioCompra,true);
                    eliminarMatricula();
                }
                var_dump($miObj->getParameter("Ds_Response"));
                    var_dump(json_decode($decodec,true));
            }
            else 
            {
                echo "<h2><strong>Compra en Espera. Pago no Realizado</h2></strong>";
                $datosCompra = json_decode($decodec,true);
                if ($datosCompra !== null && isset($datosCompra['Ds_Amount']))
                {
                    $precioCompra = intval($datosCompra['Ds_Amount'])/100;
                    require_once "../models/model_devolver.php";
                    insertarPago($precioCompra,false);
                    eliminarMatricula();
                }
                var_dump($miObj->getParameter("Ds_Response"));
                    var_dump(json_decode($decodec,true));
            }
        } 
        
    }
    else{
        if (!empty( $_GET ) )
        {//URL DE RESP. ONLINE
                
            $version = $_GET["Ds_SignatureVersion"];
            $datos = $_GET["Ds_MerchantParameters"];
            $signatureRecibida = $_GET["Ds_Signature"];
                
            $decodec = $miObj->decodeMerchantParameters($datos);
            $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
            $firma = $miObj->createMerchantSignatureNotif($kc,$datos);
        
            if ($firma === $signatureRecibida){
                $codigoRespuesta = intval($miObj->getParameter("Ds_Response"));
                if($codigoRespuesta >= 0 && $codigoRespuesta < 100)
                {
                    print "<h2><strong>Compra Realizada Con Exito</h2></strong>";
                    $datosCompra = json_decode($decodec,true);
                    if ($datosCompra !== null && isset($datosCompra['Ds_Amount']))
                    {
                        $precioCompra = intval($datosCompra['Ds_Amount'])/100;
                        require_once "../models/model_devolver.php";
                        insertarPago($precioCompra,true);
                        eliminarMatricula();
                    }
                    var_dump($miObj->getParameter("Ds_Response"));
                    var_dump(json_decode($decodec,true));
                }
                else 
                {
                    echo "<h2><strong>Compra en Espera. Pago no Realizado</h2></strong>";
                    $datosCompra = json_decode($decodec,true);
                    if ($datosCompra !== null && isset($datosCompra['Ds_Amount']))
                    {
                        $precioCompra = intval($datosCompra['Ds_Amount'])/100;
                        require_once "../models/model_devolver.php";
                        insertarPago($precioCompra,false);
                        eliminarMatricula();
                    }
                    var_dump($miObj->getParameter("Ds_Response"));
                    var_dump(json_decode($decodec,true));
                }
            } 
        }
        else{
            die("No se recibió respuesta");
        }
    }


?>

<a href="controller_welcome.php">Volver a la Pagina Principal</a>
