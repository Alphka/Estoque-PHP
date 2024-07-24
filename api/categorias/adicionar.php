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

header("Content-Type: application/json; charset=utf-8");

try{
	if(isset($nome) && !empty($nome = trim($nome))){
		$query = mysqli_query($connection, "INSERT INTO categoria (nome) VALUES ('$nome')");

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
		"message" => "Nome inválido"
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
