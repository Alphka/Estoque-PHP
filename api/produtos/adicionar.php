<?php

session_start();

if(!isset($_SESSION["usuario"])){
	http_response_code(401);
	header("Location: ../../login.php");
	return;
}

if($_SERVER["REQUEST_METHOD"] !== "POST") return http_response_code(405);

include "../../conexao.php";

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

?>
