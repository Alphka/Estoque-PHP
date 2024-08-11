<?php

try{
	$env = parse_ini_file(".env");
}catch(Exception $error){
	$env = parse_ini_file(".env.example");
}

$DB_HOST = $env["HOST"];
$DB_NAME = $env["DB_NAME"];
$DB_USER = $env["DB_USER"];
$DB_PORT = $env["DB_PORT"];
$DB_PASSWORD = $env["DB_PASSWORD"];

$connection = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT);

if(!$connection || $connection->connect_error){
	$message = "Falha ao conectar ao banco de dados";
	if($connection) die("$message: $connection->connect_error");
	else die($message);
}
