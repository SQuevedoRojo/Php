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

?>