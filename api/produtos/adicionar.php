<?php

session_start();

if(!isset($_SESSION["usuario"])){
	http_response_code(401);
	header("Location: ../../login.php");
	return;
}

if($_SERVER["REQUEST_METHOD"] !== "POST") return http_response_code(405);

include "../../conexao.php";

$nome = isset($_POST["nome"]) ? trim($_POST["nome"]) : "";
$numero = isset($_POST["numero"]) ? trim($_POST["numero"]) : "";
$categoria = isset($_POST["categoria"]) ? trim($_POST["categoria"]) : "";
$quantidade = isset($_POST["quantidade"]) ? trim($_POST["quantidade"]) : "";
$fornecedor = isset($_POST["fornecedor"]) ? trim($_POST["fornecedor"]) : "";

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

	if(empty($nome) || empty($numero) || empty($categoria) || empty($quantidade) || empty($fornecedor)) return invalidateRequest("Todos os campos do formulário precisam ser preenchidos");
	if(!mysqli_num_rows(mysqli_query($connection, "SELECT * FROM categoria WHERE nome = '$categoria'"))) return invalidateRequest("Categoria inválida");
	if(!mysqli_num_rows(mysqli_query($connection, "SELECT * FROM fornecedor WHERE nome = '$fornecedor'"))) return invalidateRequest("Fornecedor inválido");

	$query = mysqli_query($connection, "INSERT INTO estoque (numero, nome, categoria, quantidade, fornecedor) VALUES ('$numero', '$nome', '$categoria', '$quantidade', '$fornecedor')");

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
