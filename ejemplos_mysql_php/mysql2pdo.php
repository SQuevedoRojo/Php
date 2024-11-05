<?php
/*Inserción en tabla - mysql PDO*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleadosnn";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO emple_dpto (dni,cod_dpto, fecha_ini,fecha_fi) VALUES ('33333333C','D002', '2024-11-05',null)";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>