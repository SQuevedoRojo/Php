<?php

    function recuperarDatosCompra($idCliente,$fecIni,$fecFin)
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT i.InvoiceId as InvoiceId,InvoiceLineId,CustomerId,InvoiceDate,Total,TrackId,UnitPrice,Quantity from invoice i,invoiceline il where CustomerId = $idCliente and DATE(InvoiceDate) >= :fecIni and DATE(InvoiceDate) <= :fecFin order by 1,2");
            $stmt->bindParam(':fecIni', $fecIni);
            $stmt->bindParam(':fecFin', $fecFin);
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