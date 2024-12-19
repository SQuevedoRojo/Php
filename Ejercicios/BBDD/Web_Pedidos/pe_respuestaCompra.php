<?php

    include_once "funciones_comunes.php";
    include_once "funciones_session.php";
    include_once "tpv/apiRedsys.php";
    include_once "funciones_altaped.php";
?>
    <html> 
    <body> 
    <?php
    
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
            print "<h2><strong>Compra Realizada Con Exito</h2></strong>";
            $datosCompra = json_decode($decodec,true);
            if ($datosCompra !== null && isset($datosCompra['Ds_Amount']))
            {
                $precioCompra = intval($data['Ds_Amount'])/100;
                insertarPago($precioCompra,true);
            }
        } else {
            echo "<h2><strong>Compra en Espera. Pago no Realizado</h2></strong>";
            $datosCompra = json_decode($decodec,true);
            if ($datosCompra !== null && isset($datosCompra['Ds_Amount']))
            {
                $precioCompra = intval($data['Ds_Amount'])/100;
                insertarPago($precioCompra,false);
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
                print "<h2><strong>Compra Realizada Con Exito</h2></strong>";
                $datosCompra = json_decode($decodec,true);
                if ($datosCompra !== null && isset($datosCompra['Ds_Amount']))
                {
                    $precioCompra = intval($data['Ds_Amount'])/100;
                    insertarPago($precioCompra,true);
                }
            } else {
                echo "<h2><strong>Compra en Espera. Pago no Realizado</h2></strong>";
                $datosCompra = json_decode($decodec,true);
                if ($datosCompra !== null && isset($datosCompra['Ds_Amount']))
                {
                    $precioCompra = intval($data['Ds_Amount'])/100;
                    insertarPago($precioCompra,false);
                }
            }
        }
        else{
            die("No se recibió respuesta");
        }
    }
    
    ?>
    <a href="./pe_altaped.php"><input type="button" value="Volver a La Pagina Anterior"></a>
    </body> 
    </html> 