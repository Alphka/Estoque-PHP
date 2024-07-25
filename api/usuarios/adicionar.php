<?php

session_start();

if(!isset($_SESSION["usuario"])) return header("Location: ../../login.php");

if($_SERVER["REQUEST_METHOD"] !== "POST") return http_response_code(405);

include "../../conexao.php";

$nome = isset($_POST["nome"]) ? trim($_POST["nome"]) : null;
$email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
$senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : null;
$nivel = isset($_POST["nivel"]) ? trim($_POST["nivel"]) : null;

function invalidateRequest(string $message, int $status = 400){
	global $connection;

	header("Content-Type: application/json; charset=utf-8", true, $status);
	echo json_encode([
		"success" => false,
		"message" => $message
	]);

	mysqli_close($connection);
}

try{
	if(empty($nome) || empty($email) || empty($senha) || empty($nivel)) return invalidateRequest("Todos os campos do formulário precisam ser preenchidos");

	$query = mysqli_query($connection, "INSERT INTO usuarios (nome, email, senha, nivel) VALUES ('$nome', '$email', '$senha', '$nivel')");

	if(!$query) return invalidateRequest(mysqli_error($connection), 500);

	header("Content-Type: application/json; charset=utf-8");
	echo json_encode([ "success" => true ]);
	mysqli_close($connection);
}catch(Exception $error){
	invalidateRequest($error->getMessage(), 500);
}
