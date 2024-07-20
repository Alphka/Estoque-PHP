<?php

$nome = $_POST["nome"];
$senha = $_POST["senha"];

session_start();

if(isset($nome) && isset($senha)){
	include "../conexao.php";

	$query = mysqli_query($connection, "SELECT * FROM usuarios WHERE nome = '$nome' and senha = '$senha'");

	if($query && mysqli_num_rows($query)){
		$_SESSION["usuario"] = $nome;
		mysqli_close($connection);
		header("Location: ../index.php");
		return;
	}
}

header("Location: ../login.php");

?>
