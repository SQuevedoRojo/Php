<?php

    function recuperarListadoCanciones($indice)
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT t.TrackId as TrackId,t.Name as TName,a.Title as ATitle,ar.Name as ArName,m.Name as MName,g.Name as GName,t.Composer as TComposer,t.UnitPrice as TUnitPrice from track t,album a,artist ar,mediatype m,genre g where t.AlbumId = a.AlbumId and a.ArtistId = ar.ArtistId and t.MediaTypeId = m.MediaTypeId and t.GenreId = g.GenreId order by t.TrackId limit 20 offset $indice");
            //$stmt->bindParam(':indice', $indice);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $resultado;
    }

    function recuperarInformacionCliente()
    {
        $idCliente = devolverId();
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT Address,City,State,Country,PostalCode from customer  where CustomerId = $idCliente");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $resultado;
    }

    function insertarPago($importeTotal,$infoCliente,$DsResponse,$cardDetails)
    {
        $invoiceId = saberUltimoInvoiceId();
        $conteoCesta = saberCantidadCesta();
        $invoiceLineId = saberUltimoInvoiceLineId();
        require_once("controller_session.php");
        $idCliente = devolverId();
        try
        {
            $GLOBALS["conn"]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $GLOBALS["conn"]->beginTransaction();
            $stmt = $GLOBALS["conn"]->prepare("INSERT INTO invoice (InvoiceId,CustomerId,InvoiceDate,BillingAddress,BillingCity,BillingState,BillingCountry,BillingPostalCode,NumTarjeta,DsResponse,Total) VALUES (:invId,:custId,now(),:bilAdd,:bilCi,:bilSt,:bilCo,:bilPC,:numTar,:ds,:total)");
            $stmt->bindParam(':invId', $invoiceId);
            $stmt->bindParam(':custId', $idCliente);
            $stmt->bindParam(':bilAdd', $infoCliente[0]["Addres"]);
            $stmt->bindParam(':bilCi', $infoCliente[0]["City"]);
            $stmt->bindParam(':bilSt', $infoCliente[0]["State"]);
            $stmt->bindParam(':bilCo', $infoCliente[0]["Country"]);
            $stmt->bindParam(':bilPC', $infoCliente[0]["PostalCode"]);
            $stmt->bindParam(':numTar', $cardDetails);
            $stmt->bindParam(':ds', $DsResponse);
            $stmt->bindParam(':total', $importeTotal);
            $stmt -> execute();
            foreach ($conteoCesta as $cesta)
            {
                $stmt = $GLOBALS["conn"]->prepare("INSERT INTO invoiceline (InvoiceLineId,InvoiceId,TrackId,UnitPrice,Quantity) VALUES (:invLiId,:invId,:trackId,:unPrice,:cantidad)");
                $stmt->bindParam(':invLiId', $invoiceLineId);
                $stmt->bindParam(':invId', $invoiceId);
                $stmt->bindParam(':trackId', $cesta["TrackId"]);
                $stmt->bindParam(':unPrice', $cesta["TUnitPrice"]);
                $stmt->bindParam(':cantidad', $cesta["cantidad"]);
                $stmt -> execute();
                $invoiceLineId += 1;
            }
            $GLOBALS["conn"] -> commit();
        }
        catch(PDOException $e)
        {
            $GLOBALS["conn"] -> rollBack();
            echo "Error: " . $e->getMessage();
        }
    }

    function saberCantidadCesta()
    {
        require_once("controller_session.php");
        $cesta = devolverCesta();
        
        $conteo = array();

        foreach ($cesta as $cancion) {
            $trackId = $cancion[0];

            if (!isset($conteo[$trackId])) {
                $conteo[$trackId] = [
                    'TrackId' => $cancion[0],
                    'TName' => $cancion[1],
                    'TUnitPrice' => $cancion[2],
                    'cantidad' => 0
                ];
            }
            
            $conteo[$trackId]['cantidad'] += 1;
        }

        $conteoCesta = array_values($conteo);

        return $conteoCesta;
    }

    function saberUltimoInvoiceId()
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT (max(InvoiceId) + 1) as invoiceId from invoice");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $resultado[0]["invoiceId"];
    }

    function saberUltimoInvoiceLineId()
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT (max(InvoiceLineId) + 1) as invoiceLineId from invoiceline");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $resultado[0]["invoiceId"];
    }
?>