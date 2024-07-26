<?php

session_start();

if(!isset($_SESSION["usuario"])) return header("Location: ../../login.php");

if($_SERVER["REQUEST_METHOD"] !== "GET") return http_response_code(405);

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

$categorias = mysqli_query($connection, "SELECT * FROM categoria WHERE id = '$id'");

if(mysqli_num_rows($categorias) == 0){
	http_response_code(404);
	return;
}

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
	$query = mysqli_query($connection, "DELETE FROM categoria WHERE id = '$id'");

	if(!$query) return invalidateRequest(mysqli_error($connection), 500);

	if(strpos($_SERVER["HTTP_ACCEPT"], "text/html")){
		header("Location: ../../categorias/listar.php");
		return;
	}

	header("Content-Type: application/json; charset=utf-8");
	echo json_encode([ "success" => true ]);
	mysqli_close($connection);
}catch(Exception $error){
	invalidateRequest($error->getMessage(), 500);
}
