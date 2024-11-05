<?php
/*Inserción en tabla - MySQLi Object-oriented*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleadosnn";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO emple (dni,nombre,salario,fec_nac) VALUES ('33333333C', 'William',2500,'2024-01-01')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

