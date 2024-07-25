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

header("Content-Type: application/json; charset=utf-8");

try{
	if(!empty($nome)){
		$query = mysqli_query($connection, "INSERT INTO fornecedor (nome) VALUES ('$nome')");

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
		mysqli_close($connection);
		return;
	}

	http_response_code(400);
	echo json_encode([
		"success" => false,
		"message" => "Nome inválido"
	]);
	mysqli_close($connection);
}catch(Exception $error){
	http_response_code(500);
	echo json_encode([
		"success" => false,
		"message" => $error->getMessage()
	]);
}

mysqli_close($connection);
