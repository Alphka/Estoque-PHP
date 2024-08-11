<?php

session_start();

if(!isset($_SESSION["usuario"])) return header("Location: ../../login.html");

if($_SERVER["REQUEST_METHOD"] !== "POST") return http_response_code(405);

$queries = [];
parse_str($_SERVER["QUERY_STRING"], $queries);

$id = isset($queries["id"]) ? $queries["id"] : null;

try{
	if(!$id || empty($id = trim($id))) throw new Exception("ID is not defined");
	$id = intval($id);
}catch(Exception $error){
	header("Location: ../../produtos/listar.php", true, 301);
	return;
}

include "../../conexao.php";

$produtos = mysqli_query($connection, "SELECT * FROM estoque WHERE id = '$id'");

if(mysqli_num_rows($produtos) == 0){
	http_response_code(404);
	return;
}

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
	if(!mysqli_num_rows(mysqli_query($connection, "SELECT * FROM categoria WHERE nome = '$categoria'"))) return invalidateRequest("Categoria inválida");
	if(!mysqli_num_rows(mysqli_query($connection, "SELECT * FROM fornecedor WHERE nome = '$fornecedor'"))) return invalidateRequest("Fornecedor inválido");

	$query = mysqli_query($connection, "UPDATE estoque SET numero = '$numero', nome = '$nome', categoria = '$categoria', quantidade = '$quantidade', fornecedor = '$fornecedor' WHERE id = '$id'");

	if(!$query) return invalidateRequest(mysqli_error($connection), 500);

	if(strpos($_SERVER["HTTP_ACCEPT"], "text/html")){
		header("Location: ../../produtos/editar.php?id=$id");
		return;
	}

	header("Content-Type: application/json; charset=utf-8");
	echo json_encode([ "success" => true ]);
	mysqli_close($connection);
}catch(Exception $error){
	invalidateRequest($error->getMessage(), 500);
}
