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

$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$nivel = $_POST["nivel"];

header("Content-Type: application/json; charset=utf-8");

try{
	if(
		isset($nome) && !empty($nome = trim($nome)) &&
		isset($email) && !empty($email = trim($email)) &&
		isset($senha) && !empty($senha = trim($senha)) &&
		isset($nivel) && !empty($nivel = trim($nivel))
	){
		$query = mysqli_query($connection, "INSERT INTO usuarios (nome, email, senha, nivel) VALUES ('$nome', '$email', '$senha', '$nivel')");

		if(!$query){
			http_response_code(500);
			echo json_encode([
				"success" => false,
				"message" => mysqli_error($connection)
			]);
			return;

		}

		echo json_encode([ "success" => true ]);
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

?>
