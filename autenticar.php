<?php

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

session_start();

if(isset($usuario) && isset($senha)){
	$_SESSION["usuario"] = $usuario;

	$conectou = false;

	include "conexao.php";

	if($conectou){
		$sql = "SELECT * FROM usuarios WHERE nome_usuario = '$usuario' and senha_usuario = '$senha'";

		$query = mysqli_query($connection, $sql);

		if(mysqli_num_rows($query) && mysqli_fetch_array($query)){
			header("Location: menu.php");
			return;
		}
	}
}

header("Location: index.php")

?>
