<?php

    function recuperarDatosCompra($idCliente)
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT i.InvoiceId as InvoiceId,InvoiceLineId,CustomerId,InvoiceDate,Total,TrackId,UnitPrice,Quantity from invoice i,invoiceline il where CustomerId = $idCliente order by 1,2 LIMIT 6723");
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

?>