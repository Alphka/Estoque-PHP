<?php

$nome = isset($_POST["nome"]) ? trim($_POST["nome"]) : "";
$email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
$senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : "";
$nivel = isset($_POST["nivel"]) ? trim($_POST["nivel"]) : "";

session_start();

if(!empty($nome) && !empty($email) && !empty($senha) && !empty($nivel)){
	include "../conexao.php";

	$query = mysqli_query($connection, "INSERT INTO usuarios (nome, email, senha, nivel) VALUES ('$nome', '$email', '$senha', '$nivel')");

	if($query){
		$_SESSION["usuario"] = $nome;
		mysqli_close($connection);
		header("Location: ../index.php");
		return;
	}
}

header("Location: ../register.php");
