<?php

$host = "localhost";
$port = 3306;
$user = "root";
$password = "";
$dbName = "estoque";

$connection = mysqli_connect($host, $user, $password, $dbName, $port);

if($connection->connect_error){
	die("Falha ao conectar ao banco de dados: " . $conn->connect_error);
}

?>
