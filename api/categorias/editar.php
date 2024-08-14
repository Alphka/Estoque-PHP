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
	header("Location: ../../categorias/listar.php", true, 301);
	return;
}

include "../../conexao.php";

$categorias = mysqli_query($connection, "SELECT * FROM categoria WHERE id = '$id' LIMIT 1");

if(mysqli_num_rows($categorias) == 0){
	http_response_code(404);
	return;
}

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
	if(empty($nome)) return invalidateRequest("Todos os campos do formulário precisam ser preenchidos");

	$query = mysqli_query($connection, "UPDATE categoria SET nome = '$nome' WHERE id = '$id' LIMIT 1");

	if(!$query) return invalidateRequest(mysqli_error($connection), 500);

	if(strpos($_SERVER["HTTP_ACCEPT"], "text/html")){
		header("Location: ../../categorias/editar.php?id=$id");
		return;
	}

	header("Content-Type: application/json; charset=utf-8");
	echo json_encode([ "success" => true ]);
	mysqli_close($connection);
}catch(Exception $error){
	invalidateRequest($error->getMessage(), 500);
}
