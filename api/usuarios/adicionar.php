<?php

session_start();

if(!isset($_SESSION["usuario"])){
	http_response_code(401);
	header("Location: ../../login.php");
	return;
}

if($_SERVER["REQUEST_METHOD"] !== "POST") return http_response_code(405);

include "../../conexao.php";

if(!$connection){
	http_response_code(500);
	return;
}

$nome = isset($_POST["nome"]) ? $_POST["nome"] : null;
$email = isset($_POST["email"]) ? $_POST["email"] : null;
$senha = isset($_POST["senha"]) ? $_POST["senha"] : null;
$nivel = isset($_POST["nivel"]) ? $_POST["nivel"] : null;

header("Content-Type: application/json; charset=utf-8");

try{
	if(!empty($nome) && !empty($email) && !empty($senha) && !empty($nivel)){
		$query = mysqli_query($connection, "INSERT INTO usuarios (nome, email, senha, nivel) VALUES ('$nome', '$email', '$senha', '$nivel')");

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
		"message" => "Todos os campos do formulário precisam ser preenchidos"
	]);
}catch(Exception $error){
	http_response_code(500);
	echo json_encode([
		"success" => false,
		"message" => $error->getMessage()
	]);
}

mysqli_close($connection);
