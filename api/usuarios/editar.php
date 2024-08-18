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
	header("Location: ../../usuarios/listar.php", true, 301);
	return;
}

include "../../conexao.php";

$usuarios = mysqli_query($connection, "SELECT id FROM usuario WHERE id = $id LIMIT 1");

if(mysqli_num_rows($usuarios) === 0){
	http_response_code(404);
	return;
}

$nome = isset($_POST["nome"]) ? trim($_POST["nome"]) : "";
$email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
$senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : "";
$nivel = isset($_POST["nivel"]) ? trim($_POST["nivel"]) : "";

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
	if(empty($nome) || empty($email) || empty($senha) || empty($nivel)) return invalidateRequest("Todos os campos do formulário precisam ser preenchidos");

	$query = mysqli_query($connection, "UPDATE usuario SET nome = '$nome', email = '$email', senha = '$senha', nivel = '$nivel' WHERE id = $id LIMIT 1");

	if(!$query) return invalidateRequest(mysqli_error($connection), 500);

	if(strpos($_SERVER["HTTP_ACCEPT"], "text/html")){
		header("Location: ../../usuarios/editar.php?id=$id");
		return;
	}

	header("Content-Type: application/json; charset=utf-8");
	echo json_encode([ "success" => true ]);
	mysqli_close($connection);
}catch(Exception $error){
	invalidateRequest($error->getMessage(), 500);
}
