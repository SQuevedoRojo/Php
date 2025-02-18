<?php

    function saberMusicaMasDescargada($fecIni,$fecFin)
    {
        try
        {
            $stmt = $GLOBALS["conn"]->prepare("SELECT t.TrackId as TrackId, sum(Quantity) as Quantity,t.Name as TName,a.Title as ATitle,ar.Name as ArName,m.Name as MName,g.Name as GName,t.Composer as TComposer from invoiceline il,invoice i,track t,album a,artist ar,mediatype m,genre g where i.InvoiceId = il.InvoiceId and DATE(InvoiceDate) >= :fecIni and DATE(InvoiceDate) <= :fecFin and t.AlbumId = a.AlbumId and a.ArtistId = ar.ArtistId and t.MediaTypeId = m.MediaTypeId and t.GenreId = g.GenreId and t.TrackId = il.TrackId group by il.TrackId order by sum(Quantity) desc,t.TrackId");
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