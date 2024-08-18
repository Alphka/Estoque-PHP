<?php

session_start();

if(!isset($_SESSION["usuario"])) return header("Location: ../../login.html");

if($_SERVER["REQUEST_METHOD"] !== "POST") return http_response_code(405);

include "../../conexao.php";

$nome = isset($_POST["nome"]) ? trim($_POST["nome"]) : "";
$numero = isset($_POST["numero"]) ? trim($_POST["numero"]) : "";
$categoria = isset($_POST["categoria"]) ? trim($_POST["categoria"]) : "";
$quantidade = isset($_POST["quantidade"]) ? trim($_POST["quantidade"]) : "";
$fornecedor = isset($_POST["fornecedor"]) ? trim($_POST["fornecedor"]) : "";

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
	if(empty($nome) || empty($numero) || empty($categoria) || empty($quantidade) || empty($fornecedor)) return invalidateRequest("Todos os campos do formulário precisam ser preenchidos");
	if(!mysqli_num_rows(mysqli_query($connection, "SELECT id FROM categoria WHERE nome = '$categoria'"))) return invalidateRequest("Categoria inválida");
	if(!mysqli_num_rows(mysqli_query($connection, "SELECT id FROM fornecedor WHERE nome = '$fornecedor'"))) return invalidateRequest("Fornecedor inválido");

	$query = mysqli_query($connection, "INSERT INTO estoque (numero, nome, categoria, quantidade, fornecedor) VALUES ('$numero', '$nome', '$categoria', '$quantidade', '$fornecedor')");

	if(!$query) return invalidateRequest(mysqli_error($connection), 500);

	header("Content-Type: application/json; charset=utf-8");
	echo json_encode([ "success" => true ]);
	mysqli_close($connection);
}catch(Exception $error){
	invalidateRequest($error->getMessage(), 500);
}
