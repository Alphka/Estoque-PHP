<?php

$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$nivel = $_POST["nivel"];

session_start();

if(
	isset($nome) && !empty($nome = trim($nome)) &&
	isset($email) && !empty($email = trim($email)) &&
	isset($senha) && !empty($senha = trim($senha)) &&
	isset($nivel) && !empty($nivel = trim($nivel))
){
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

?>
