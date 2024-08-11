<?php

if(file_exists(".env")){
	$env = parse_ini_file(".env");
}else{
	$env = parse_ini_file(".env.example");
	copy(dirname(__FILE__) . "/.env.example", dirname(__FILE__) . "/.env");
}

if(!$env) die("Failed to get environment variables");

$DB_HOST = $env["HOST"];
$DB_NAME = $env["DB_NAME"];
$DB_USER = $env["DB_USER"];
$DB_PORT = $env["DB_PORT"];
$DB_PASSWORD = $env["DB_PASSWORD"];

$connection = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT) or die("Falha ao conectar ao banco de dados");

if($connection->connect_error){
	die($connection->connect_error);
}
