<?php

session_start();

if(!isset($_SESSION["usuario"])){
	http_response_code(401);
	header("Location: ../../login.php");
	return;
}

include "../../conexao.php";

if(!$connection){
	http_response_code(500);
	return;
}

$nome = $_POST["nome"];

header("Content-Type: application/json; charset=utf-8");

try{
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
}catch(Exception $error){
	http_response_code(500);
	echo json_encode([
		"success" => false,
		"message" => $error->getMessage()
	]);
}

mysqli_close($connection);

?>
