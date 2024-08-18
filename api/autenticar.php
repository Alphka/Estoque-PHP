<?php

if($_SERVER["REQUEST_METHOD"] !== "POST") return http_response_code(405);

$nome = isset($_POST["nome"]) ? trim($_POST["nome"]) : "";
$senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : "";

session_start();

if(!empty($nome) && !empty($senha)){
	include "../conexao.php";

	$query = mysqli_query($connection, "SELECT id FROM usuario WHERE nome = '$nome' and senha = '$senha' LIMIT 1");

	if($query && mysqli_num_rows($query)){
		$_SESSION["usuario"] = $nome;
		mysqli_close($connection);
		header("Location: ../index.php");
		return;
	}

	mysqli_close($connection);
}

header("Location: ../login.html");
