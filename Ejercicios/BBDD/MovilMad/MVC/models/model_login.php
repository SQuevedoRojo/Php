<?php
    
    try
    {
        $stmt = $conn->prepare("SELECT idcliente,nombre,apellido,fecha_baja,pendiente_pago from rclientes where idcliente = :contra and email = :usu");
        $stmt->bindParam(':usu', $usu);
        $stmt->bindParam(':contra', $contra);
        $stmt -> execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }

?>