<?php

$nome = $_POST["nome"];
$senha = $_POST["senha"];

session_start();

if(isset($nome) && isset($senha)){
	$_SESSION["usuario"] = $nome;

	include "../conexao.php";

	if($conectou){
		$query = mysqli_query($connection, "SELECT * FROM usuarios WHERE nome = '$nome' and senha = '$senha'");

		if(mysqli_num_rows($query) && mysqli_fetch_array($query)){
			header("Location: ../index.php");
			return;
		}
	}
}

header("Location: ../login.php");

?>
