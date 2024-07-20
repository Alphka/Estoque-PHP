<?php

$host = "localhost";
$port = 3306;
$user = "root";
$password = "";
$dbName = "estoque";

$connection = mysqli_connect($host, $user, $password, $dbName, $port) or die("Could not connect to mysql database");

if($connection){
	// echo "Conectado com sucesso";
	$conectou = true;
}else{
	// echo "Falha na conexão";
	$conectou = false;
}

?>
