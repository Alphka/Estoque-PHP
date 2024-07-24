<?php

session_start();

if(!isset($_SESSION["usuario"])){
	http_response_code(401);
	header("Location: ../../login.php");
	return;
}

if($_SERVER["REQUEST_METHOD"] !== "POST") return http_response_code(405);

$queries = array();
parse_str($_SERVER["QUERY_STRING"], $queries);

$id = $queries["id"];

try{
	if(!$id || empty($id = trim($id))) throw "ID is not defined";
	$id = intval($id);
}catch(Exception $error){
	http_response_code(422);
	return;
}

include "../../conexao.php";

$produtos = mysqli_query($connection, "SELECT * FROM estoque WHERE id = '$id'");

if(mysqli_num_rows($produtos) == 0){
	http_response_code(404);
	return;
}

$produto = mysqli_fetch_array($produtos);

$nome = $_POST["nome"];
$numero = $_POST["numero"];
$categoria = $_POST["categoria"];
$quantidade = $_POST["quantidade"];
$fornecedor = $_POST["fornecedor"];

header("Content-Type: application/json; charset=utf-8");

try{
	function invalidateRequest(string $message){
		global $connection;

		http_response_code(400);
		echo json_encode([
			"success" => false,
			"message" => $message
		]);

		mysqli_close($connection);
	}

	if(
		!isset($nome) || empty($nome = trim($nome)) ||
		!isset($numero) || empty($numero = trim($numero)) ||
		!isset($categoria) || empty($categoria = trim($categoria)) ||
		!isset($quantidade) || empty($quantidade = trim($quantidade)) ||
		!isset($fornecedor) || empty($fornecedor = trim($fornecedor))
	) return invalidateRequest("Todos os campos do formulário precisam ser preenchidos");

	if(!mysqli_num_rows(mysqli_query($connection, "SELECT * FROM categoria WHERE nome = '$categoria'"))){
		invalidateRequest("Categoria inválida");
		return;
	}

	if(!mysqli_num_rows(mysqli_query($connection, "SELECT * FROM fornecedor WHERE nome = '$fornecedor'"))){
		invalidateRequest("Fornecedor inválido");
		return;
	}

	$query = mysqli_query($connection, "UPDATE estoque SET numero = '$numero', nome = '$nome', categoria = '$categoria', quantidade = '$quantidade', fornecedor = '$fornecedor' WHERE id = '$id'");

	if(!$query){
		http_response_code(500);
		echo json_encode([
			"success" => false,
			"message" => mysqli_error($connection)
		]);
		mysqli_close($connection);
		return;
	}

	echo json_encode([ "success" => true ]);
}catch(Exception $error){
	http_response_code(500);
	echo json_encode([
		"success" => false,
		"message" => $error->getMessage()
	]);
}

mysqli_close($connection);

?>
