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
            $stmt = $GLOBALS["conn"]->prepare("SELECT Addres,City,State,Country from customer  where CustomerId = $idCliente");
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

    /*function insertarPago($importeTotal,$infoCliente,$DsResponse,$cardDetails)
    {
        $invoiceId = saberUltimoInvoiceId();
        try
        {
            $GLOBALS["conn"]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $GLOBALS["conn"]->beginTransaction();
            $stmt = $GLOBALS["conn"]->prepare("UPDATE ralquileres set fecha_devolucion = now(),preciototal=:precio,fechahorapago=now(),num_pago=:numpago where matricula = :mat and idcliente=:id and num_pago is null");
            $stmt->bindParam(':precio', $precioCompra);
            $stmt->bindParam(':numpago', $numPago);
            $stmt->bindParam(':mat', $matricula);
            $stmt->bindParam(':id', $id);
        }
        catch(PDOException $e)
        {
            $GLOBALS["conn"] -> rollBack();
            echo "Error: " . $e->getMessage();
        }
    }*/

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
?>