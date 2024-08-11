<?php

session_start();

if(!isset($_SESSION["usuario"])) return header("Location: ../../login.html");

if($_SERVER["REQUEST_METHOD"] !== "POST") return http_response_code(405);

include "../../conexao.php";

$nome = isset($_POST["nome"]) ? trim($_POST["nome"]) : "";

function invalidateRequest(string $message, int $status = null){
	global $connection;

	header("Content-Type: application/json; charset=utf-8", true, $status || 400);
	echo json_encode([
		"success" => false,
		"message" => $message
	]);

	mysqli_close($connection);
}

try{
	if(empty($nome)) return invalidateRequest("Nome inválido");

	$query = mysqli_query($connection, "INSERT INTO categoria (nome) VALUES ('$nome')");

	if(!$query) return invalidateRequest(mysqli_error($connection), 500);

	header("Content-Type: application/json; charset=utf-8");
	echo json_encode([ "success" => true ]);
	mysqli_close($connection);
}catch(Exception $error){
	invalidateRequest($error->getMessage(), 500);
}
