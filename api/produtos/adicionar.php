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
	if(
		isset($nome) && !empty($nome = trim($nome)) &&
		isset($numero) && !empty($numero = trim($numero)) &&
		isset($categoria) && !empty($categoria = trim($categoria)) &&
		isset($quantidade) && !empty($quantidade = trim($quantidade)) &&
		isset($fornecedor) && !empty($fornecedor = trim($fornecedor))
	){
		$query = mysqli_query($connection, "INSERT INTO estoque (numero, nome, categoria, quantidade, fornecedor) VALUES ('$numero', '$nome', '$categoria', '$quantidade', '$fornecedor')");

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


}catch(Exception $error){
	http_response_code(500);
	echo json_encode([
		"success" => false,
		"message" => $error->getMessage()
	]);
}

mysqli_close($connection);

?>
