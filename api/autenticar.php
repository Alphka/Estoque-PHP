<?php

if($_SERVER["REQUEST_METHOD"] !== "POST") return http_response_code(405);

$nome = $_POST["nome"];
$senha = $_POST["senha"];

session_start();

if(
	isset($nome) && !empty($nome = trim($nome)) &&
	isset($senha) && !empty($senha = trim($senha))
){
	include "../conexao.php";

	$query = mysqli_query($connection, "SELECT * FROM usuarios WHERE nome = '$nome' and senha = '$senha'");

	if($query && mysqli_num_rows($query)){
		$_SESSION["usuario"] = $nome;
		mysqli_close($connection);
		header("Location: ../index.php");
		return;
	}

	mysqli_close($connection);
}

header("Location: ../login.php");

?>
