<?php

$env = parse_ini_file(".env");

$DB_HOST = $env["HOST"];
$DB_NAME = $env["DB_NAME"];
$DB_USER = $env["DB_USER"];
$DB_PORT = $env["DB_PORT"];
$DB_PASSWORD = $env["DB_PASSWORD"];

$connection = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT);

if($connection->connect_error){
	die("Falha ao conectar ao banco de dados: $conn->connect_error");
}
